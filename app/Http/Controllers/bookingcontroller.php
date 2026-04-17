<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rentalitem;
use App\Models\Rental;

class bookingcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::orderBy('name')->get();

        return view('booking', compact('products', 'categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date', 'after_or_equal:date_start'],
            'reason' => ['string','required'],
            'items' => ['required', 'string'],
        ]);

        $items = json_decode($data['items'], true);
        if (!is_array($items) || empty($items)) {
            return back()->withErrors(['items' => 'Pilih minimal 1 item.'])->withInput();
        }

        $productIds = collect($items)->pluck('product_id')->filter()->unique()->values();
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        foreach ($items as $item) {
            $productId = $item['product_id'] ?? null;
            $qty = (int) ($item['quantity'] ?? 0);
            if (!$productId || $qty <= 0 || !$products->has($productId)) {
                return back()->withErrors(['items' => 'Item tidak valid.'])->withInput();
            }
            if ($products[$productId]->stock < $qty) {
                return back()->withErrors(['items' => 'Stok tidak mencukupi untuk beberapa item.'])->withInput();
            }
        }

        $orderCode = 'BK-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));

        DB::transaction(function () use ($request, $data, $items, $orderCode) {
            $booking = Rental::create([
                'user_id' => $request->user()->id,
                'rental_code' => $orderCode,
                'product_id' => $items[0]['product_id'],
                'rental_start_date' => $data['date_start'],
                'rental_end_date' => $data['date_end'],
                'reason' => $data['reason'],
                'rental_status' => 'pending',
            ]);

            foreach ($items as $item) {
                Rentalitem::create([
                    'rental_id' => $booking->id,
                    'product_id' => $item['product_id'],
                    'quantity' => (int) $item['quantity'],
                ]);
            }


            });

        return redirect()->route('booking.status')->with('status', 'Pengajuan berhasil dikirim.');
    }

    public function cancel(Request $request, Rental $booking)
    {
        $user = $request->user();

        if (!$user || $booking->user_id !== $user->id) {
            return back()->withErrors(['error' => 'Anda tidak bisa membatalkan booking ini.']);
        }

        if ($booking->rental_status !== 'pending') {
            return back()->withErrors(['error' => 'Hanya booking pending yang bisa dibatalkan.']);
        }

        $booking->update(['rental_status' => 'cancelled']);

        return redirect()->route('booking.status')->with('status', 'Booking berhasil dibatalkan.');
    }

    public function returnTool(Request $request, Rental $booking)
    {
        $user = $request->user();

        if (!$user || $booking->user_id !== $user->id) {
            return back()->withErrors(['error' => 'Anda tidak bisa mengubah booking ini.']);
        }

        if ($booking->rental_status !== 'aktif') {
            return back()->withErrors(['error' => 'Pengembalian hanya bisa diajukan saat status aktif.']);
        }

        $booking->update(['rental_status' => 'menunggu konfirmasi']);

        return redirect()->route('booking.status')->with('status', 'Pengembalian sudah diajukan dan menunggu konfirmasi staff.');
    }

    public function status(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $bookings = Rental::with(['items.product'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $bookingStatuses = [];
        foreach ($bookings as $booking) {
            $bookingStatuses[$booking->rental_code] = [
                'status' => $booking->rental_status ?? 'pending',
                'hasRentals' => true,
            ];
        }

        return view('booking-status', compact('bookings', 'bookingStatuses'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

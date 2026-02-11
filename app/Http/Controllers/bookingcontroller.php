<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Booking;
use App\Models\Bookingitem;
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
            'notes' => ['nullable', 'string'],
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
            $booking = Booking::create([
                'user_id' => $user->id,
                'order_code' => $orderCode,
                'date_start' => $data['date_start'],
                'date_end' => $data['date_end'],
                'notes' => $data['notes'] ?? null,
                'booking_status' => 'pending',
            ]);

            foreach ($items as $item) {
                Bookingitem::create([
                    'booking_id' => $booking->id,
                    'product_id' => $item['product_id'],
                    'quantity' => (int) $item['quantity'],
                ]);
            }
        });

        return redirect()->route('booking.status')->with('status', 'Pengajuan berhasil dikirim.');
    }

    public function status(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $bookings = Booking::with(['items.product'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $orderCodes = $bookings->pluck('order_code')->filter()->values();
        $rentals = Rental::where(function ($query) use ($orderCodes) {
            foreach ($orderCodes as $code) {
                $query->orWhere('rental_code', 'like', $code . '-%');
            }
        })->get();

        $rentalsByBooking = $rentals->groupBy(function ($rental) {
            $parts = explode('-', $rental->rental_code);
            array_pop($parts);
            return implode('-', $parts);
        });

        $bookingStatuses = [];
        foreach ($orderCodes as $code) {
            $group = $rentalsByBooking->get($code, collect());
            if ($group->isEmpty()) {
                $bookingStatuses[$code] = [
                    'status' => 'pending',
                    'hasRentals' => false,
                ];
                continue;
            }

            $unique = $group->pluck('rental_status')->unique();
            $status = $unique->count() === 1 ? $unique->first() : 'mixed';

            $bookingStatuses[$code] = [
                'status' => $status,
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

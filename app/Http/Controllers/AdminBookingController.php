<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'items.product'])
            ->where('booking_status', 'pending')
            ->latest()
            ->get();

        return view('admin.order', compact('bookings'));
    }

    public function approve(Booking $booking)
    {
        if ($booking->booking_status === 'approved') {
            return back()->with('status', 'Booking sudah di-approve.');
        }

        DB::transaction(function () use ($booking) {
            $booking->loadMissing(['items.product']);
            $counter = 1;

            foreach ($booking->items as $item) {
                $quantity = max(1, (int) $item->quantity);
                for ($i = 0; $i < $quantity; $i += 1) {
                    Rental::create([
                        'rental_code' => $booking->order_code . '-' . $counter,
                        'user_id' => $booking->user_id,
                        'product_id' => $item->product_id,
                        'rental_start_date' => $booking->date_start,
                        'rental_end_date' => $booking->date_end,
                        'rental_status' => 'menunggu diambil',
                    ]);
                    $counter += 1;
                }
            }

            $booking->update(['booking_status' => 'approved']);
        });

        return back()->with('status', 'Booking berhasil di-approve.');
    }

    public function reject(Booking $booking)
    {
        $booking->update(['booking_status' => 'rejected']);

        return back()->with('status', 'Booking berhasil di-reject.');
    }

    public function status()
    {
        $bookings = Booking::with(['user', 'items.product'])
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

        return view('admin.status', compact('bookings', 'bookingStatuses'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'rental_status' => ['required', 'in:menunggu diambil,aktif,dikembalikan,dibatalkan'],
        ]);

        $rentals = Rental::where('rental_code', 'like', $booking->order_code . '-%')->get();

        if ($rentals->isEmpty()) {
            return back()->with('status', 'Belum ada rental untuk booking ini.');
        }

        foreach ($rentals as $rental) {
            $updates = ['rental_status' => $data['rental_status']];

            if ($data['rental_status'] === 'aktif' && !$rental->rental_start_time) {
                $updates['rental_start_time'] = now();
            }

            if ($data['rental_status'] === 'dikembalikan') {
                $updates['rental_end_time'] = now();
            }

            $rental->update($updates);
        }

        return back()->with('status', 'Status rental berhasil diperbarui.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Rental::with(['user', 'items.product'])
            ->where('rental_status', 'pending')
            ->latest()
            ->get();

        return view('admin.order', compact('bookings'));
    }

    public function approve(Rental $booking)
    {
        $rentals = Rental::where('rental_code', $booking->rental_code)
            ->orWhere('rental_code', 'like', $booking->rental_code . '-%')
            ->get();

        if ($rentals->isEmpty()) {
            return back()->with('status', 'Belum ada rental untuk booking ini.');
        }

        foreach ($rentals as $relatedRental) {
            $relatedRental->update(['rental_status' => 'approved']);
        }

        Activity::create([
            'name' => Auth::user()->name,
            'role' => Auth::user()->role,
            'activity' => 'approve booking',
            'object' => $booking->rental_code,
        ]);

        return back()->with('status', 'Booking berhasil di-approve.');
    }

    public function reject(Rental $rental)
    {
        $rental->update(['rental_status' => 'rejected']);

        Activity::create([
            'name' => Auth::user()->name,
            'role' => Auth::user()->role,
            'activity' => 'reject booking',
            'object' => $rental->rental_code,
        ]);

        return back()->with('status', 'Booking berhasil di-reject.');
    }

    public function status()
    {
        $bookings = Rental::with(['user', 'items.product'])
            ->latest()
            ->get();

        $bookingStatuses = [];
        foreach ($bookings as $booking) {
            $bookingStatuses[$booking->rental_code] = [
                'status' => $booking->rental_status ?? 'pending',
                'hasRentals' => true,
            ];
        }

        return view('admin.status', compact('bookings', 'bookingStatuses'));
    }

    public function updateStatus(Request $request, Rental $booking)
    {
        $data = $request->validate([
            'rental_status' => ['required', 'in:approved,menunggu diambil,aktif,menunggu konfirmasi,dikembalikan,dibatalkan,terlambat dikembalikan'],
        ]);

        $rentals = Rental::where('rental_code', $booking->rental_code)
            ->orWhere('rental_code', 'like', $booking->rental_code . '-%')
            ->get();

        if ($rentals->isEmpty()) {
            return back()->with('status', 'Belum ada rental untuk booking ini.');
        }

        foreach ($rentals as $rental) {
            $updates = ['rental_status' => $data['rental_status']];

            if ($data['rental_status'] === 'aktif' && !$rental->rental_start_time) {
                $updates['rental_start_time'] = now();
            }

            if ($data['rental_status'] === 'dikembalikan'|| $data['rental_status'] === 'terlambat dikembalikan') {
                $updates['rental_end_time'] = now();
            }

            $rental->update($updates);
        }

        Activity::create([
            'name' => $request->user()->name,
            'role' => $request->user()->role,
            'activity' => 'update status',
            'object' => $booking->rental_code . ' - ' . $data['rental_status'],
        ]);

        return back()->with('status', 'Status rental berhasil diperbarui.');
    }
}

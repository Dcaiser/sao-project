<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Bookingitem;
use App\Models\Rental;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();

        $bookingToday = Booking::whereDate('created_at', $today)->count();
        $bookingTotal = Booking::count();
        $bookingPending = Booking::where('booking_status', 'pending')->count();
        $bookingApproved = Booking::where('booking_status', 'approved')->count();

        $rentalToday = Rental::whereDate('created_at', $today)->count();
        $rentalActive = Rental::where('rental_status', 'renting')->count();

        $totalUsers = User::count();
        $totalProducts = Product::count();
        $productsOutOfStock = Product::where('stock', '<=', 0)->count();

        $recentBookings = Booking::with('user', 'items.product')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $approvedItemsByCategory = Bookingitem::whereHas('booking', function ($query) {
            $query->where('booking_status', 'approved');
        })
            ->with(['product.category', 'booking'])
            ->get()
            ->groupBy(function ($item) {
                return $item->product?->category?->name ?? 'Tanpa Kategori';
            });

        return view('admin.dashboard', compact(
            'bookingToday',
            'bookingTotal',
            'bookingPending',
            'bookingApproved',
            'rentalToday',
            'rentalActive',
            'totalUsers',
            'totalProducts',
            'productsOutOfStock',
            'recentBookings',
            'approvedItemsByCategory'
        ));
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
        //
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

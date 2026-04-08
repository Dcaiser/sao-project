<?php

namespace App\Http\Controllers;

use App\Models\Bookingitem;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * Controller untuk menampilkan dan menyinkronkan data laporan peminjaman.
 */
class reportcontroller extends Controller
{
    /**
     * Menampilkan halaman laporan dengan filter tanggal dan status.
     *
     * Alur utama:
     * 1. Sinkronisasi data tabel report dari data booking item terbaru.
     * 2. Validasi parameter filter dari request.
     * 3. Ambil data laporan sesuai rentang tanggal dan status.
     * 4. Hitung ringkasan statistik untuk ditampilkan di dashboard.
     */
    public function index(Request $request)
    {
        $this->syncReports();

        $data = $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['nullable', 'in:all,pending,approved,menunggu diambil,aktif,terlambat dikembalikan,dikembalikan,dibatalkan,rejected,cancelled'],
        ]);

        $startDate = $data['start_date'] ?? Carbon::now()->startOfMonth()->toDateString();
        $endDate = $data['end_date'] ?? Carbon::now()->toDateString();
        $status = $data['status'] ?? 'all';

        $reportItems = Report::query()
            ->whereBetween('rental_start_date', [$startDate, $endDate])
            ->when($status !== 'all', function ($query) use ($status) {
                $query->where('rental_status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $summary = [
            'transactions' => $reportItems->pluck('rental_id')->unique()->count(),
            'items' => $reportItems->count(),
            'units' => $reportItems->sum('quantity'),
            'products' => $reportItems->pluck('product_id')->unique()->count(),
        ];

        $statusCounts = $reportItems
            ->groupBy(fn ($item) => $item->rental?->rental_status ?? 'unknown')
            ->map->count();

        $statusOptions = [
            'all' => 'Semua Status',
            'approved' => 'Approved',
            'menunggu diambil' => 'Menunggu Diambil',
            'aktif' => 'Aktif',
            'terlambat dikembalikan' => 'Terlambat Dikembalikan',
            'dikembalikan' => 'Dikembalikan',
            'dibatalkan' => 'Dibatalkan',
            'pending' => 'Pending',
            'rejected' => 'Rejected',
            'cancelled' => 'Cancelled',
        ];

        return view('admin.report', compact(
            'reportItems',
            'summary',
            'statusCounts',
            'statusOptions',
            'startDate',
            'endDate',
            'status'
        ));
    }

    /**
     * Menampilkan form pembuatan resource baru.
     */
    public function create()
    {
        //
    }

    /**
     * Menyimpan resource baru ke storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Menampilkan detail resource tertentu.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Menampilkan form edit untuk resource tertentu.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Memperbarui resource tertentu di storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Menghapus resource tertentu dari storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Menyinkronkan tabel reports dari data bookingitems beserta relasinya.
     *
     * Mekanisme sinkronisasi:
     * - Jika tidak ada booking item, seluruh data report dihapus.
     * - Jika ada data, lakukan upsert berdasarkan bookingitem_id.
     * - Hapus baris report yang sudah tidak punya pasangan booking item.
     */
    private function syncReports(): void
    {
        $items = Bookingitem::with(['rental.user', 'product.category'])->get();

        if ($items->isEmpty()) {
            Report::query()->delete();
            return;
        }

        $rows = $items->map(function ($item) {
            $rental = $item->rental;

            return [
                'bookingitem_id' => $item->id,
                'rental_id' => $item->rental_id,
                'product_id' => $item->product_id,
                'rental_code' => $rental?->rental_code,
                'borrower_name' => $rental?->user?->name,
                'borrower_phone' => $rental?->user?->phone,
                'product_name' => $item->product?->name,
                'category_name' => $item->product?->category?->name,
                'quantity' => $item->quantity,
                'rental_start_date' => $rental?->rental_start_date,
                'rental_end_date' => $rental?->rental_end_date,
                'rental_status' => $rental?->rental_status ?? 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->all();

        Report::upsert(
            $rows,
            ['bookingitem_id'],
            [
                'rental_id',
                'product_id',
                'rental_code',
                'borrower_name',
                'borrower_phone',
                'product_name',
                'category_name',
                'quantity',
                'rental_start_date',
                'rental_end_date',
                'rental_status',
                'updated_at',
            ]
        );

        $existingBookingItemIds = $items->pluck('id')->all();
        Report::whereNotIn('bookingitem_id', $existingBookingItemIds)->delete();
    }
}

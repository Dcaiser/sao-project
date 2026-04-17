@extends('layouts.admin')

@section('title', 'Laporan Peminjaman')
@section('header', 'Laporan Peminjaman')

@section('content')
	<style>
		@media print {
			aside,
			header,
			.no-print {
				display: none !important;
			}

			body {
				background: #ffffff !important;
			}

			main {
				padding: 0 !important;
				margin: 0 !important;
			}

			.print-card {
				box-shadow: none !important;
				border-color: #cbd5e1 !important;
			}

			.page-break {
				break-inside: avoid;
				page-break-inside: avoid;
			}
		}
	</style>

	@php
		$statusMap = [
			'approved' => ['label' => 'Approved', 'class' => 'bg-sky-100 text-sky-700'],
			'menunggu diambil' => ['label' => 'Menunggu Diambil', 'class' => 'bg-cyan-100 text-cyan-700'],
			'aktif' => ['label' => 'Aktif', 'class' => 'bg-emerald-100 text-emerald-700'],
			'dikembalikan' => ['label' => 'Dikembalikan', 'class' => 'bg-slate-200 text-slate-700'],
			'dibatalkan' => ['label' => 'Dibatalkan', 'class' => 'bg-rose-100 text-rose-700'],
			'pending' => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-700'],
			'rejected' => ['label' => 'Rejected', 'class' => 'bg-rose-100 text-rose-700'],
			'cancelled' => ['label' => 'Cancelled', 'class' => 'bg-rose-100 text-rose-700'],
		];
	@endphp

	<div class="space-y-6">
		<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200 print-card">
			<div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between no-print">
				<div>
					<h2 class="text-lg font-semibold text-slate-900">Buat Laporan Peminjaman</h2>
					<p class="text-sm text-slate-500">Filter data peminjaman alat, lalu cetak hasilnya langsung dari halaman ini.</p>
				</div>
				<div class="flex flex-wrap gap-3">
						<a
							href="{{ route('admin.report.pdf', ['start_date' => $startDate, 'end_date' => $endDate, 'status' => $status]) }}"
							class="inline-flex items-center px-5 text-sm font-semibold text-white transition h-11 rounded-xl bg-[#0F2854] hover:bg-[#0B1F44]"
						>
							Unduh PDF
						</a>
					<a href="{{ route('admin.report') }}" class="inline-flex items-center px-5 text-sm font-semibold transition border h-11 rounded-xl border-slate-200 text-slate-700 hover:bg-slate-50">
						Reset Filter
					</a>
				</div>
			</div>

			<form method="GET" action="{{ route('admin.report') }}" class="grid gap-4 mt-6 lg:grid-cols-4 no-print">
				<div>
					<label class="block mb-2 text-sm font-medium text-slate-700">Tanggal Awal</label>
					<input type="date" name="start_date" value="{{ $startDate }}" class="w-full px-4 h-11 rounded-xl border-slate-200" />
				</div>
				<div>
					<label class="block mb-2 text-sm font-medium text-slate-700">Tanggal Akhir</label>
					<input type="date" name="end_date" value="{{ $endDate }}" class="w-full px-4 h-11 rounded-xl border-slate-200" />
				</div>
				<div>
					<label class="block mb-2 text-sm font-medium text-slate-700">Status</label>
					<select name="status" class="w-full px-4 h-11 rounded-xl border-slate-200">
						@foreach ($statusOptions as $value => $label)
							<option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
						@endforeach
					</select>
				</div>

				<div class="flex items-end">
					<button type="submit" class="w-full px-5 text-sm font-semibold text-white transition h-11 rounded-xl bg-slate-900 hover:bg-slate-800">
						Tampilkan Laporan
					</button>
				</div>

			</form>

			<div class="grid gap-4 mt-6 sm:grid-cols-2 xl:grid-cols-4">
				<div class="p-5 border rounded-2xl border-slate-200 bg-slate-50">
					<p class="text-sm text-slate-500">Transaksi</p>
					<div class="mt-2 text-3xl font-semibold text-slate-900">{{ $summary['transactions'] }}</div>
				</div>
				<div class="p-5 border rounded-2xl border-slate-200 bg-slate-50">
					<p class="text-sm text-slate-500">Baris Data</p>
					<div class="mt-2 text-3xl font-semibold text-slate-900">{{ $summary['items'] }}</div>
				</div>
				<div class="p-5 border rounded-2xl border-slate-200 bg-slate-50">
					<p class="text-sm text-slate-500">Total Unit Dipinjam</p>
					<div class="mt-2 text-3xl font-semibold text-slate-900">{{ $summary['units'] }}</div>
				</div>
			</div>

			<div class="grid gap-3 mt-4 sm:grid-cols-2 lg:grid-cols-4 no-print">

				@if ($statusCounts->isEmpty())
					<div class="px-4 py-3 text-sm border border-dashed rounded-xl border-slate-200 text-slate-500 no-print sm:col-span-2 lg:col-span-4">
						Belum ada data untuk filter yang dipilih.
					</div>
				@endif
			</div>
		</div>

		<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200 print-card page-break">
			<div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
				<div>
					<h3 class="text-lg font-semibold text-slate-900">Detail Laporan</h3>
					<p class="text-sm text-slate-500">Periode {{ $startDate }} sampai {{ $endDate }} | Dibuat {{ now()->format('d M Y H:i') }}</p>
				</div>
				<p class="text-sm text-slate-500 no-print">Gunakan tombol cetak untuk menyimpan laporan ini sebagai PDF.</p>
			</div>

			<div class="mt-4 overflow-x-auto">
				<table class="w-full text-sm text-left">
					<thead class="text-xs uppercase text-slate-500 bg-slate-50">
						<tr>
							<th class="px-4 py-3">No</th>
							<th class="px-4 py-3">Kode Booking</th>
							<th class="px-4 py-3">Peminjam</th>
							<th class="px-4 py-3">Alat</th>
							<th class="px-4 py-3">Kategori</th>
							<th class="px-4 py-3">Qty</th>
							<th class="px-4 py-3">Periode</th>
							<th class="px-4 py-3">Status</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-slate-200">
						@forelse ($reportItems as $index => $item)
							@php
								$meta = $statusMap[$item->rental_status ?? ''] ?? ['label' => ucfirst(str_replace('_', ' ', $item->rental_status ?? 'unknown')), 'class' => 'bg-slate-100 text-slate-700'];
							@endphp
							<tr>
								<td class="px-4 py-3 font-medium text-slate-900">{{ $index + 1 }}</td>
								<td class="px-4 py-3 text-slate-700">{{ $item->rental_code ?? '-' }}</td>
								<td class="px-4 py-3 text-slate-700">
									<div class="font-medium text-slate-900">{{ $item->borrower_name ?? '-' }}</div>
									<div class="text-xs text-slate-500">{{ $item->borrower_phone ?? '-' }}</div>
								</td>
								<td class="px-4 py-3 text-slate-700">{{ $item->product_name ?? '-' }}</td>
								<td class="px-4 py-3 text-slate-700">{{ $item->category_name ?? '-' }}</td>
								<td class="px-4 py-3 font-medium text-slate-900">{{ $item->quantity }}</td>
								<td class="px-4 py-3 text-slate-700">
									{{ $item->rental_start_date ?? '-' }} - {{ $item->rental_end_date ?? '-' }}
								</td>
								<td class="px-4 py-3">
									<span class="px-3 py-1 text-xs font-semibold rounded-full {{ $meta['class'] }}">{{ $meta['label'] }}</span>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="8" class="px-4 py-10 text-sm text-center text-slate-500">Tidak ada data peminjaman pada filter yang dipilih.</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

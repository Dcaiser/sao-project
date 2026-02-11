@extends('layouts.admin')

@section('title', 'Status Peminjaman')
@section('header', 'Status Peminjaman')

@section('content')
	<div class="space-y-6">
		<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
			<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
				<div>
					<h2 class="text-lg font-semibold text-slate-900">Status Peminjaman</h2>
					<p class="text-sm text-slate-500">Pantau seluruh pengajuan peminjaman.</p>
				</div>
				<div class="flex flex-wrap gap-3">
					<input type="text" placeholder="Cari nama / kode booking" class="w-full px-4 h-11 rounded-xl border-slate-200 lg:w-64" />
					<select class="px-3 h-11 rounded-xl border-slate-200">
						<option>Semua Status</option>
						<option>Pending</option>
						<option>Approved</option>
						<option>Rejected</option>
					</select>
					<button class="h-11 rounded-xl bg-[#0F2854] px-5 text-sm font-semibold text-white hover:bg-[#0B1F44] transition">Filter</button>
				</div>
			</div>
		</div>

		@if (session('status'))
			<div class="p-4 text-sm border rounded-2xl border-emerald-200 bg-emerald-50 text-emerald-700">
				{{ session('status') }}
			</div>
		@endif

		<div class="grid gap-4">
			@forelse ($bookings as $booking)
				@php
					$itemSummary = $booking->items->map(function ($item) {
						$name = $item->product?->name ?? 'Item';
						return $name . ' (' . $item->quantity . 'x)';
					})->implode(', ');
					$statusMeta = $bookingStatuses[$booking->order_code] ?? ['status' => 'pending', 'hasRentals' => false];
					$badgeClass = match ($statusMeta['status']) {
						'aktif' => 'bg-emerald-100 text-emerald-700',
						'dikembalikan' => 'bg-slate-100 text-slate-600',
						'dibatalkan' => 'bg-rose-100 text-rose-700',
						'mixed' => 'bg-indigo-100 text-indigo-700',
						default => 'bg-amber-100 text-amber-700',
					};
					$isOverdue = $statusMeta['status'] === 'active' && now()->greaterThan($booking->date_end);
				@endphp
				<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
					<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
						<div>
							<p class="text-sm text-slate-500">Kode Booking</p>
							<h3 class="text-lg font-semibold text-slate-900">{{ $booking->order_code }}</h3>
							<p class="text-sm text-slate-500">
								{{ $booking->user?->name ?? '-' }}
								@if ($booking->user?->phone)
									• {{ $booking->user->phone }}
								@endif
							</p>
						</div>
						<div class="flex items-center gap-2">
							<span class="rounded-full px-3 py-1 text-xs font-semibold {{ $badgeClass }}">
								{{ str_replace('_', ' ', ucfirst($statusMeta['status'])) }}
							</span>
							@if ($isOverdue)
								<span class="px-3 py-1 text-xs font-semibold rounded-full bg-rose-50 text-rose-600">Melebihi batas</span>
							@endif
						</div>
					</div>
					<div class="grid gap-4 mt-4 sm:grid-cols-2 lg:grid-cols-4">
						<div>
							<p class="text-xs text-slate-500">Periode</p>
							<p class="text-sm font-medium text-slate-900">{{ $booking->date_start }} - {{ $booking->date_end }}</p>
						</div>
						<div>
							<p class="text-xs text-slate-500">Item</p>
							<p class="text-sm font-medium text-slate-900">{{ $itemSummary ?: '-' }}</p>
						</div>
					</div>
					<form class="flex flex-wrap items-center gap-3 mt-5" method="POST" action="{{ route('admin.booking.status.update', $booking) }}">
						@csrf
						@method('PATCH')
						<select name="rental_status" class="px-3 h-11 rounded-xl border-slate-200" @disabled(!$statusMeta['hasRentals'])>
							<option value="menunggu diambil'" @selected($statusMeta['status'] === 'menunggu diambil')>menunggu diambil</option>
							<option value="aktif" @selected($statusMeta['status'] === 'aktif')>aktif</option>
							<option value="dikembalikan" @selected($statusMeta['status'] === 'dikembalikan')>dikembalikan</option>
							<option value="dibatalkan" @selected($statusMeta['status'] === 'dibatalkan')>dibatalkan</option>
						</select>
						<button type="submit" class="h-11 rounded-xl bg-[#0F2854] px-5 text-sm font-semibold text-white hover:bg-[#0B1F44] transition" @disabled(!$statusMeta['hasRentals'])>
							Update Status
						</button>
					</form>
				</div>
			@empty
				<div class="p-6 text-sm text-center bg-white border border-dashed rounded-2xl border-slate-200 text-slate-500">
					Belum ada data peminjaman.
				</div>
			@endforelse
		</div>
	</div>
@endsection

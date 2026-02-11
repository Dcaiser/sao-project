@extends('layouts.admin')

@section('title', 'Status Peminjaman')
@section('header', 'Status Peminjaman')

@section('content')
	<div class="space-y-6">
		<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
			<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
				<div>
					<h2 class="text-lg font-semibold text-slate-900">Status Peminjaman</h2>
					<p class="text-sm text-slate-500">Pantau seluruh pengajuan peminjaman.</p>
				</div>
				<div class="flex flex-wrap gap-3">
					<input type="text" placeholder="Cari nama / kode booking" class="h-11 w-full rounded-xl border-slate-200 px-4 lg:w-64" />
					<select class="h-11 rounded-xl border-slate-200 px-3">
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
			<div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
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
						'active' => 'bg-emerald-100 text-emerald-700',
						'completed' => 'bg-slate-100 text-slate-600',
						'canceled' => 'bg-rose-100 text-rose-700',
						'mixed' => 'bg-indigo-100 text-indigo-700',
						default => 'bg-amber-100 text-amber-700',
					};
					$isOverdue = $statusMeta['status'] === 'active' && now()->greaterThan($booking->date_end);
				@endphp
				<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
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
								<span class="rounded-full bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-600">Melebihi batas</span>
							@endif
						</div>
					</div>
					<div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
						<div>
							<p class="text-xs text-slate-500">Periode</p>
							<p class="text-sm font-medium text-slate-900">{{ $booking->date_start }} - {{ $booking->date_end }}</p>
						</div>
						<div>
							<p class="text-xs text-slate-500">Item</p>
							<p class="text-sm font-medium text-slate-900">{{ $itemSummary ?: '-' }}</p>
						</div>
					</div>
					<form class="mt-5 flex flex-wrap items-center gap-3" method="POST" action="{{ route('admin.booking.status.update', $booking) }}">
						@csrf
						@method('PATCH')
						<select name="rental_status" class="h-11 rounded-xl border-slate-200 px-3" @disabled(!$statusMeta['hasRentals'])>
							<option value="waiting_pickup" @selected($statusMeta['status'] === 'waiting_pickup')>Waiting pickup</option>
							<option value="active" @selected($statusMeta['status'] === 'active')>Active</option>
							<option value="completed" @selected($statusMeta['status'] === 'completed')>Completed</option>
							<option value="canceled" @selected($statusMeta['status'] === 'canceled')>Canceled</option>
						</select>
						<button type="submit" class="h-11 rounded-xl bg-[#0F2854] px-5 text-sm font-semibold text-white hover:bg-[#0B1F44] transition" @disabled(!$statusMeta['hasRentals'])>
							Update Status
						</button>
					</form>
				</div>
			@empty
				<div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6 text-center text-sm text-slate-500">
					Belum ada data peminjaman.
				</div>
			@endforelse
		</div>
	</div>
@endsection

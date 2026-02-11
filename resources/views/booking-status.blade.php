@extends('layouts.template')

@section('content')
	<section class="bg-slate-50">
		<div class="px-6 py-12 lg:px-12">
			<div class="mb-8">
				<p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#0F2854]">Status</p>
				<h1 class="mt-3 text-3xl font-semibold text-slate-900">Status Peminjaman</h1>
				<p class="mt-2 text-slate-600">Pantau progres pengajuan peminjaman Anda.</p>
			</div>

			@if (session('status'))
				<div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
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
					@endphp
					<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
						<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
							<div>
								<p class="text-sm text-slate-500">Kode Booking</p>
								<h3 class="text-lg font-semibold text-slate-900">{{ $booking->order_code }}</h3>
							</div>
							<span class="rounded-full px-3 py-1 text-xs font-semibold {{ $badgeClass }}">
								{{ str_replace('_', ' ', ucfirst($statusMeta['status'])) }}
							</span>
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
					</div>
				@empty
					<div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6 text-center text-sm text-slate-500">
						Belum ada pengajuan peminjaman.
					</div>
				@endforelse
			</div>
		</div>
	</section>
@endsection

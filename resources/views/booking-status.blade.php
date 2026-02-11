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
				<div class="p-4 mb-6 text-sm border rounded-2xl border-emerald-200 bg-emerald-50 text-emerald-700">
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
							'waiting_pickup' => 'bg-amber-100 text-amber-700',
							'renting' => 'bg-emerald-100 text-emerald-700',
							'returned' => 'bg-slate-100 text-slate-600',
							'cancelled' => 'bg-rose-100 text-rose-700',
							'mixed' => 'bg-indigo-100 text-indigo-700',
							default => 'bg-amber-100 text-amber-700',
						};
					@endphp
					<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
						<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
							<div>
								<p class="text-sm text-slate-500">Kode Booking</p>
								<h3 class="text-lg font-semibold text-slate-900">{{ $booking->order_code }}</h3>
							</div>
							<span class="rounded-full px-3 py-1 text-xs font-semibold {{ $badgeClass }}">
								{{ str_replace('_', ' ', ucfirst($statusMeta['status'])) }}
							</span>
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
					@if ($booking->booking_status === 'pending')
						<div class="mt-4">
							<form method="POST" action="{{ route('booking.cancel', $booking) }}" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?');">
								@csrf
								@method('DELETE')
								<button type="submit" class="inline-flex rounded-lg bg-rose-500 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-600 transition">
									Batalkan Booking
								</button>
							</form>
						</div>
					@endif
				</div>
				@empty
					<div class="p-6 text-sm text-center bg-white border border-dashed rounded-2xl border-slate-200 text-slate-500">
						Belum ada pengajuan peminjaman.
					</div>
				@endforelse
			</div>
		</div>
	</section>
@endsection

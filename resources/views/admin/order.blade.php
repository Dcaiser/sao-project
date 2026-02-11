@extends('layouts.admin')

@section('title', 'Kotak Masuk Booking')
@section('header', 'Kotak Masuk Booking')

@section('content')
	<div class="space-y-6">
		<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
			<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
				<div>
					<h2 class="text-lg font-semibold text-slate-900">Booking Masuk</h2>
					<p class="text-sm text-slate-500">Data penyewa yang menunggu approval.</p>
				</div>
				<div class="flex flex-wrap gap-3">
					<input type="text" placeholder="Cari nama / kode booking" class="h-11 w-full rounded-xl border-slate-200 px-4 lg:w-64" />
					<select class="h-11 rounded-xl border-slate-200 px-3">
						<option>Semua Status</option>
						<option>Menunggu</option>
						<option>Perlu Review</option>
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
						<span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Menunggu</span>
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
					<div class="mt-5 flex flex-wrap gap-3">
						<form method="POST" action="{{ route('admin.inbox.approve', $booking) }}">
							@csrf
							@method('PATCH')
							<button type="submit" class="rounded-xl bg-emerald-500 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-600 transition">Approve</button>
						</form>
						<form method="POST" action="{{ route('admin.inbox.reject', $booking) }}">
							@csrf
							@method('PATCH')
							<button type="submit" class="rounded-xl bg-rose-500 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-600 transition">Reject</button>
						</form>
					</div>
				</div>
			@empty
				<div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6 text-center text-sm text-slate-500">
					Belum ada booking menunggu approval.
				</div>
			@endforelse
		</div>
	</div>
@endsection

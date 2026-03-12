@extends('layouts.admin')

@section('title', 'Kotak Masuk Booking')
@section('header', 'Kotak Masuk Booking')

@section('content')
	<div class="space-y-6">
		<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
			<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
				<div>
					<h2 class="text-lg font-semibold text-slate-900">Booking Masuk</h2>
					<p class="text-sm text-slate-500">Data penyewa yang menunggu approval.</p>
				</div>
				<div class="flex flex-wrap gap-3">
					<input type="text" placeholder="Cari nama / kode booking" class="w-full px-4 h-11 rounded-xl border-slate-200 lg:w-64" />
					<select class="px-3 h-11 rounded-xl border-slate-200">
						<option>Semua Status</option>
						<option>Menunggu</option>
						<option>Perlu Review</option>
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
					$statusMap = [
						'pending' => ['label' => 'Menunggu', 'class' => 'bg-amber-100 text-amber-700'],
						'menunggu diambil' => ['label' => 'Menunggu Diambil', 'class' => 'bg-sky-100 text-sky-700'],
						'aktif' => ['label' => 'Aktif', 'class' => 'bg-emerald-100 text-emerald-700'],
						'dikembalikan' => ['label' => 'Dikembalikan', 'class' => 'bg-slate-200 text-slate-700'],
						'dibatalkan' => ['label' => 'Dibatalkan', 'class' => 'bg-rose-100 text-rose-700'],
						'rejected' => ['label' => 'Ditolak', 'class' => 'bg-rose-100 text-rose-700'],
					];

					$currentStatus = $statusMap[$booking->rental_status] ?? [
						'label' => ucfirst($booking->rental_status ?? 'Unknown'),
						'class' => 'bg-slate-100 text-slate-700',
					];

					$itemSummary = $booking->items->map(function ($item) {
						$name = $item->product?->name ?? 'Item';
						return $name . ' (' . $item->quantity . 'x)';
					})->implode(', ');
				@endphp
				<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
					<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
						<div>
							<p class="text-sm text-slate-500">Kode Booking</p>
							<h3 class="text-lg font-semibold text-slate-900">{{ $booking->rental_code }}</h3>
							<p class="text-sm text-slate-500">
								{{ $booking->user?->name ?? '-' }}
								@if ($booking->user?->phone)
									• {{ $booking->user->phone }}
								@endif
							</p>
						</div>
						<span class="px-3 py-1 text-xs font-semibold rounded-full {{ $currentStatus['class'] }}">{{ $currentStatus['label'] }}</span>
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
                        <div>
                            <p class="text-xs text-slate-500">alasan:</p>
                            <p class="text-sm font-medium text-slate-900">{{ $booking->reason ?? '-' }}</p>
					    </div>
					</div>
					<div class="flex flex-wrap gap-3 mt-5">
						<form method="POST" action="{{ route('admin.inbox.approve', $booking) }}">
							@csrf
							@method('PATCH')
							<button type="submit" class="px-4 py-2 text-sm font-semibold text-white transition rounded-xl bg-emerald-500 hover:bg-emerald-600">Approve</button>
						</form>
						<form method="POST" action="{{ route('admin.inbox.reject', $booking) }}">
							@csrf
							@method('PATCH')
							<button type="submit" class="px-4 py-2 text-sm font-semibold text-white transition rounded-xl bg-rose-500 hover:bg-rose-600">Reject</button>
						</form>
					</div>
				</div>
			@empty
				<div class="p-6 text-sm text-center bg-white border border-dashed rounded-2xl border-slate-200 text-slate-500">
					Belum ada booking menunggu approval.
				</div>
			@endforelse
		</div>
	</div>
@endsection

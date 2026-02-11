@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard Admin')

@section('content')
	<div class="grid grid-cols-1 gap-6 lg:grid-cols-[2fr_1fr]">
		<div class="space-y-6">
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
				<div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
					<p class="text-sm text-slate-500">Booking Hari Ini</p>
					<div class="mt-3 text-2xl font-semibold text-[#0F2854]">{{ $bookingToday }}</div>
					<p class="mt-1 text-xs text-slate-500">Total: {{ $bookingTotal }}</p>
				</div>
				<div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
					<p class="text-sm text-slate-500">Pending</p>
					<div class="mt-3 text-2xl font-semibold text-amber-600">{{ $bookingPending }}</div>
					<p class="mt-1 text-xs text-slate-500">Perlu Review</p>
				</div>
				<div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
					<p class="text-sm text-slate-500">Rental Aktif</p>
					<div class="mt-3 text-2xl font-semibold text-emerald-600">{{ $rentalActive }}</div>
					<p class="mt-1 text-xs text-slate-500">Sedang Digunakan</p>
				</div>
				<div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
					<p class="text-sm text-slate-500">Stok Habis</p>
					<div class="mt-3 text-2xl font-semibold text-rose-600">{{ $productsOutOfStock }}</div>
					<p class="mt-1 text-xs text-slate-500">Perlu Diisi</p>
				</div>
			</div>

			<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
				<div class="flex items-center justify-between">
					<h2 class="text-lg font-semibold text-slate-900">Quick Actions</h2>
					<span class="text-xs text-slate-500">Akses cepat</span>
				</div>
				<div class="grid gap-4 mt-4 sm:grid-cols-2">
					<a href="/admin/inbox" class="group flex items-center justify-between rounded-2xl border border-[#0F2854]/20 bg-[#0F2854]/5 px-5 py-4 transition hover:bg-[#0F2854]/10">
						<div>
							<p class="text-sm font-semibold text-[#0F2854]">Kotak Masuk</p>
							<p class="mt-1 text-xs text-slate-500">12 pesan baru</p>
						</div>
						<span class="text-sm font-medium text-[#0F2854] group-hover:translate-x-1 transition">→</span>
					</a>
					<a href="/admin/booking-status" class="group flex items-center justify-between rounded-2xl border border-[#0F2854]/20 bg-[#0F2854]/5 px-5 py-4 transition hover:bg-[#0F2854]/10">
						<div>
							<p class="text-sm font-semibold text-[#0F2854]">Booking Status</p>
							<p class="mt-1 text-xs text-slate-500">Lihat status real time</p>
						</div>
						<span class="text-sm font-medium text-[#0F2854] group-hover:translate-x-1 transition">→</span>
					</a>
				</div>
			</div>

			<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
				<div class="flex items-center justify-between">
					<h2 class="text-lg font-semibold text-slate-900">Booking Terbaru</h2>
					<a href="{{ route('admin.booking.status') }}" class="text-sm font-medium text-[#0F2854] hover:text-[#0B1F44]">Lihat semua</a>
				</div>
				<div class="mt-4 space-y-3">
					@forelse ($recentBookings as $booking)
						@php
							$statusColor = match($booking->booking_status) {
								'approved' => 'emerald',
								'pending' => 'amber',
								'rejected' => 'rose',
								default => 'slate'
							};
							$statusText = ucfirst($booking->booking_status ?? 'pending');
						@endphp
						<div class="flex items-center justify-between px-4 py-3 border rounded-xl border-slate-200">
							<div>
								<p class="text-sm font-medium text-slate-900">{{ $booking->user?->name ?? '-' }}</p>
								<p class="text-xs text-slate-500">{{ $booking->order_code }}</p>
							</div>
							<span class="text-xs font-semibold text-{{ $statusColor }}-600">{{ $statusText }}</span>
						</div>
					@empty
						<div class="text-center py-4 text-slate-500 text-sm">
							Belum ada booking
						</div>
					@endforelse
				</div>
			</div>
		</div>

		<div class="space-y-6">
			<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
				<h2 class="text-lg font-semibold text-slate-900">Ringkasan Data</h2>
				<div class="mt-4 space-y-3">
					<div class="flex items-center justify-between">
						<span class="text-sm text-slate-600">Total Pengguna</span>
						<span class="text-sm font-semibold text-slate-900">{{ $totalUsers }}</span>
					</div>
					<div class="flex items-center justify-between">
						<span class="text-sm text-slate-600">Total Produk</span>
						<span class="text-sm font-semibold text-slate-900">{{ $totalProducts }}</span>
					</div>
					<div class="flex items-center justify-between">
						<span class="text-sm text-slate-600">Booking Disetujui</span>
						<span class="text-sm font-semibold text-emerald-600">{{ $bookingApproved }}</span>
					</div>
					<div class="flex items-center justify-between">
						<span class="text-sm text-slate-600">Rental Hari Ini</span>
						<span class="text-sm font-semibold text-blue-600">{{ $rentalToday }}</span>
					</div>
				</div>
			</div>

			<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
				<h2 class="text-lg font-semibold text-slate-900">Akses Cepat</h2>
				<div class="grid gap-3 mt-4">
					<a href="{{ route('admin.inbox') }}" class="rounded-xl bg-[#0F2854] px-4 py-3 text-sm font-semibold text-white hover:bg-[#0B1F44] transition text-center">
						Kotak Masuk ({{ $bookingPending }})
					</a>
					<a href="{{ route('admin.products.index') }}" class="rounded-xl border border-[#0F2854]/20 px-4 py-3 text-sm font-semibold text-[#0F2854] hover:bg-[#0F2854]/5 transition text-center">
						Manajemen Produk
					</a>
					<a href="{{ route('admin.roles.index') }}" class="rounded-xl border border-[#0F2854]/20 px-4 py-3 text-sm font-semibold text-[#0F2854] hover:bg-[#0F2854]/5 transition text-center">
						Manajemen Akun
					</a>
				</div>
			</div>
		</div>
	</div>
@endsection

@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard Admin')

@section('content')
	<div class="grid grid-cols-1 gap-6 lg:grid-cols-[2fr_1fr]">
		<div class="space-y-6">
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
				<div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
					<p class="text-sm text-slate-500">Booking Hari Ini</p>
					<div class="mt-3 text-2xl font-semibold text-[#0F2854]">28</div>
					<p class="mt-1 text-xs text-slate-500">+12% dari kemarin</p>
				</div>
				<div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
					<p class="text-sm text-slate-500">Item Disiapkan</p>
					<div class="mt-3 text-2xl font-semibold text-[#0F2854]">64</div>
					<p class="mt-1 text-xs text-slate-500">Pickup sore ini</p>
				</div>
				<div class="p-5 bg-white border shadow-sm rounded-2xl border-slate-200">
					<p class="text-sm text-slate-500">Kendala</p>
					<div class="mt-3 text-2xl font-semibold text-[#0F2854]">3</div>
					<p class="mt-1 text-xs text-slate-500">Perlu follow-up</p>
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
					<a href="/admin/booking-status" class="text-sm font-medium text-[#0F2854] hover:text-[#0B1F44]">Lihat semua</a>
				</div>
				<div class="mt-4 space-y-3">
					<div class="flex items-center justify-between px-4 py-3 border rounded-xl border-slate-200">
						<div>
							<p class="text-sm font-medium text-slate-900">Raka Mahendra</p>
							<p class="text-xs text-slate-500">Tenda 2P, Carrier 60L</p>
						</div>
						<span class="text-xs font-semibold text-emerald-600">Confirmed</span>
					</div>
					<div class="flex items-center justify-between px-4 py-3 border rounded-xl border-slate-200">
						<div>
							<p class="text-sm font-medium text-slate-900">Alya Pramesti</p>
							<p class="text-xs text-slate-500">Kompor, Matras, Lampu</p>
						</div>
						<span class="text-xs font-semibold text-amber-600">Pending</span>
					</div>
					<div class="flex items-center justify-between px-4 py-3 border rounded-xl border-slate-200">
						<div>
							<p class="text-sm font-medium text-slate-900">Dion Kartika</p>
							<p class="text-xs text-slate-500">Tenda 4P, Cooking Set</p>
						</div>
						<span class="text-xs font-semibold text-slate-500">Need Review</span>
					</div>
				</div>
			</div>
		</div>

		<div class="space-y-6">
			<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
				<h2 class="text-lg font-semibold text-slate-900">Ringkasan Hari Ini</h2>
				<div class="mt-4 space-y-4">
					<div class="flex items-center justify-between">
						<span class="text-sm text-slate-600">Pickup selesai</span>
						<span class="text-sm font-semibold text-slate-900">18</span>
					</div>
					<div class="flex items-center justify-between">
						<span class="text-sm text-slate-600">Pengembalian</span>
						<span class="text-sm font-semibold text-slate-900">9</span>
					</div>
					<div class="flex items-center justify-between">
						<span class="text-sm text-slate-600">Pesan masuk</span>
						<span class="text-sm font-semibold text-slate-900">12</span>
					</div>
				</div>
			</div>

			<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
				<h2 class="text-lg font-semibold text-slate-900">Kontrol Cepat</h2>
				<div class="grid gap-3 mt-4">
					<button class="rounded-xl bg-[#0F2854] px-4 py-3 text-sm font-semibold text-white hover:bg-[#0B1F44] transition">
						Hubungi Tim Gudang
					</button>
					<button class="rounded-xl border border-[#0F2854]/20 px-4 py-3 text-sm font-semibold text-[#0F2854] hover:bg-[#0F2854]/5 transition">
						Cek Kondisi Barang
					</button>
				</div>
			</div>
		</div>
	</div>
@endsection

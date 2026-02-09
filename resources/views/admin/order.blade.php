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

		<div class="grid gap-4">
			<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
				<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
					<div>
						<p class="text-sm text-slate-500">Kode Booking</p>
						<h3 class="text-lg font-semibold text-slate-900">BK-2026-021</h3>
						<p class="text-sm text-slate-500">Raka Mahendra • 08xx-1234-8899</p>
					</div>
					<span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Menunggu</span>
				</div>
				<div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
					<div>
						<p class="text-xs text-slate-500">Periode</p>
						<p class="text-sm font-medium text-slate-900">10 Feb - 13 Feb</p>
					</div>
					<div>
						<p class="text-xs text-slate-500">Item</p>
						<p class="text-sm font-medium text-slate-900">Tenda 2P, Carrier, Kompor</p>
					</div>
					<div>
						<p class="text-xs text-slate-500">Total</p>
						<p class="text-sm font-medium text-slate-900">Rp 325.000</p>
					</div>
					<div>
						<p class="text-xs text-slate-500">DP Minimal</p>
						<p class="text-sm font-medium text-slate-900">Rp 211.250</p>
					</div>
				</div>
				<div class="mt-5 flex flex-wrap gap-3">
					<button class="rounded-xl border border-[#0F2854]/20 px-4 py-2 text-sm font-semibold text-[#0F2854] hover:bg-[#0F2854]/5 transition">Detail</button>
					<button class="rounded-xl bg-emerald-500 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-600 transition">Approve</button>
					<button class="rounded-xl bg-rose-500 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-600 transition">Reject</button>
				</div>
			</div>

			<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
				<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
					<div>
						<p class="text-sm text-slate-500">Kode Booking</p>
						<h3 class="text-lg font-semibold text-slate-900">BK-2026-022</h3>
						<p class="text-sm text-slate-500">Alya Pramesti • 08xx-9876-1122</p>
					</div>
					<span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">Perlu Review</span>
				</div>
				<div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
					<div>
						<p class="text-xs text-slate-500">Periode</p>
						<p class="text-sm font-medium text-slate-900">12 Feb - 15 Feb</p>
					</div>
					<div>
						<p class="text-xs text-slate-500">Item</p>
						<p class="text-sm font-medium text-slate-900">Tenda 4P, Matras, Lampu</p>
					</div>
					<div>
						<p class="text-xs text-slate-500">Total</p>
						<p class="text-sm font-medium text-slate-900">Rp 420.000</p>
					</div>
					<div>
						<p class="text-xs text-slate-500">DP Minimal</p>
						<p class="text-sm font-medium text-slate-900">Rp 273.000</p>
					</div>
				</div>
				<div class="mt-5 flex flex-wrap gap-3">
					<button class="rounded-xl border border-[#0F2854]/20 px-4 py-2 text-sm font-semibold text-[#0F2854] hover:bg-[#0F2854]/5 transition">Detail</button>
					<button class="rounded-xl bg-emerald-500 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-600 transition">Approve</button>
					<button class="rounded-xl bg-rose-500 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-600 transition">Reject</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@extends('layouts.template')

@section('content')
	<section class="bg-slate-50">
		<div class="px-6 py-12 lg:px-12">
			<div class="mb-8">
				<p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#0F2854]">Peminjaman</p>
				<h1 class="mt-3 text-3xl font-semibold text-slate-900">Form Peminjaman Alat Ekstrakurikuler</h1>
				<p class="mt-2 text-slate-600">Lengkapi data berikut untuk melanjutkan pengajuan peminjaman.</p>
			</div>

			<div class="grid gap-6 lg:grid-cols-[2fr_1fr]">
				<form class="space-y-6" method="POST" action="{{ route('booking.store') }}">
					@csrf
					@if (session('status'))
						<div class="px-4 py-3 text-sm rounded-xl bg-emerald-50 text-emerald-700">
							{{ session('status') }}
						</div>
					@endif
					@error('items')
						<p class="text-sm text-rose-500">{{ $message }}</p>
					@enderror

					<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
						<h2 class="text-lg font-semibold text-slate-900">Periode Peminjaman</h2>
						<p class="text-sm text-slate-500">Pilih tanggal peminjaman.</p>

						<div class="grid gap-4 mt-4 sm:grid-cols-2">
							<div>
								<label class="text-sm font-medium text-slate-700">Tanggal Mulai</label>
								<input id="rental-start" name="date_start" type="date" value="{{ old('date_start') }}" class="w-full mt-2 rounded-xl border-slate-200" required />
								@error('date_start')
									<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
								@enderror
							</div>
							<div>
								<label class="text-sm font-medium text-slate-700">Tanggal Selesai</label>
								<input name="date_end" type="date" value="{{ old('date_end') }}" class="w-full mt-2 rounded-xl border-slate-200" required />
								@error('date_end')
									<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
								@enderror
							</div>
						</div>
					</div>

					<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
						<h2 class="text-lg font-semibold text-slate-900">Alasan Peminjaman</h2>
						<p class="text-sm text-slate-500">Jelaskan tujuan atau kegiatan yang membutuhkan alat.</p>

						<div class="mt-4">
							<label class="text-sm font-medium text-slate-700" for="loan-reason">Alasan</label>
							<textarea id="loan-reason" name="notes" rows="4" placeholder="Contoh: untuk persiapan lomba." class="w-full mt-2 rounded-xl border-slate-200">{{ old('notes') }}</textarea>
							@error('notes')
								<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
							@enderror
						</div>
					</div>

					<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
						<h2 class="text-lg font-semibold text-slate-900">Item yang Dipinjam</h2>
						<p class="text-sm text-slate-500">Pilih item dan jumlah.</p>

						<div class="mt-4 space-y-4">
							<div class="flex flex-col gap-4 lg:flex-row lg:items-end">
								<div class="flex-1">
									<label class="block text-sm font-medium text-slate-700" for="filter-item">Cari alat</label>
									<input id="filter-item" type="text" placeholder="Cari pramuka, olahraga, musik..." class="w-full mt-2 rounded-xl border-slate-200" />
								</div>
								<div class="w-full lg:w-56">
									<label class="block text-sm font-medium text-slate-700" for="filter-category">Kategori</label>
									<select id="filter-category" class="w-full mt-2 rounded-xl border-slate-200">
										<option>Semua</option>
										<option>Pramuka</option>
										<option>Olahraga</option>
										<option>Musik</option>
										<option>Multimedia</option>
									</select>
								</div>
								<div class="flex gap-3">
									<button type="button" class="h-11 px-5 rounded-xl bg-[#0F2854] text-white font-medium hover:bg-[#0B1F44] transition">Filter</button>
									<button type="button" class="h-11 px-5 rounded-xl border border-[#0F2854]/20 text-[#0F2854] font-medium hover:bg-[#0F2854]/5 transition">Reset</button>
								</div>
							</div>

							<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
								@foreach ($products as $product)
									<div class="p-4 border shadow-sm product-card rounded-2xl border-slate-200 bg-white/80" data-id="{{ $product->id }}" data-name="{{ $product->name }}">
									<div class="h-32 rounded-xl bg-slate-100"></div>
									<div class="mt-4">
										<p class="text-sm text-slate-500">{{ $product->category?->name ?? '-' }}</p>
										<h3 class="text-base font-semibold text-slate-900">{{ $product->name }}</h3>
										<p class="mt-2 text-sm text-slate-600">tersedia: {{ $product->stock }}</p>
									</div>
									<div class="flex items-center justify-between mt-4">
										<input type="number" min="1" value="1" class="w-20 h-10 text-center rounded-lg product-qty border-slate-200" />
										<button type="button" class="add-to-cart h-10 rounded-lg bg-[#0F2854] px-4 text-xs font-semibold text-white hover:bg-[#0B1F44] transition">Tambah</button>
									</div>
								</div>
								@endforeach

							</div>
							<div class="px-4 py-3 text-sm border border-dashed rounded-xl border-slate-200 text-slate-500">
								Pilih jumlah item langsung dari kartu produk.
							</div>
						</div>
					</div>

					<input type="hidden" name="items" id="booking-items" value="{{ old('items') }}" />


					<div class="flex flex-wrap gap-3">
						<button type="submit" class="h-11 rounded-xl bg-[#0F2854] px-6 text-sm font-semibold text-white hover:bg-[#0B1F44] transition">Ajukan Peminjaman</button>
						<a type="button" href="{{ route('home') }}" class=" rounded-xl border border-[#0F2854]/20 px-6 py-3 text-sm font-semibold text-[#0F2854] hover:bg-[#0F2854]/5 transition">Batal</a>
					</div>
				</form>

				<aside class="space-y-6">
					<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
						<h2 class="text-lg font-semibold text-slate-900">Keranjang</h2>
						<p class="text-sm text-slate-500">Item yang sudah ditambahkan.</p>
						<div id="cart-items" class="mt-4 space-y-3 text-sm text-slate-600">
							<p class="text-slate-500">Belum ada item.</p>
						</div>
					</div>

					<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
						<h2 class="text-lg font-semibold text-slate-900">Ringkasan Sewa</h2>
						<ul id="cart-summary" class="mt-4 space-y-3 text-sm text-slate-600">
							<li class="flex items-center justify-between">
								<span>Belum ada item</span>
								<span class="font-medium text-slate-900">0x</span>
							</li>
						</ul>
					</div>
				</aside>
			</div>
		</div>
	</section>

	<script>
		const rentalStart = document.getElementById('rental-start');
		const cartItems = document.getElementById('cart-items');
		const cartSummary = document.getElementById('cart-summary');
		const cart = new Map();
		const itemsInput = document.getElementById('booking-items');

		const formatDate = (date) => {
			const year = date.getFullYear();
			const month = String(date.getMonth() + 1).padStart(2, '0');
			const day = String(date.getDate()).padStart(2, '0');
			return `${year}-${month}-${day}`;
		};

		const formatCurrency = (value) => `Rp ${value.toLocaleString('id-ID')}`;

		const renderCart = () => {
			const items = Array.from(cart.values());
			if (items.length === 0) {
				cartItems.innerHTML = '<p class="text-slate-500">Belum ada item.</p>';
				cartSummary.innerHTML = '<li class="flex items-center justify-between"><span>Belum ada item</span><span class="font-medium text-slate-900">0x</span></li>';
				itemsInput.value = '';
				return;
			}
			cartItems.innerHTML = '';
			cartSummary.innerHTML = '';

			items.forEach((item) => {
				cartItems.insertAdjacentHTML(
					'beforeend',
					`<div class="flex items-center justify-between gap-3">
						<div>
							<p class="font-medium text-slate-900">${item.name}</p>
							<p class="text-xs text-slate-500">${item.qty}x</p>
						</div>
						<div class="flex items-center gap-2">
							<button type="button" class="cart-minus h-8 w-8 rounded-lg border border-slate-200 text-sm" data-id="${item.productId}">-</button>
							<span class="min-w-6 text-center text-sm font-semibold text-slate-900">${item.qty}</span>
							<button type="button" class="cart-plus h-8 w-8 rounded-lg border border-slate-200 text-sm" data-id="${item.productId}">+</button>
							<button type="button" class="cart-remove h-8 rounded-lg border border-rose-200 px-2 text-xs text-rose-600" data-id="${item.productId}">Hapus</button>
						</div>
					</div>`
				);
				cartSummary.insertAdjacentHTML(
					'beforeend',
					`<li class="flex items-center justify-between"><span>${item.name}</span><span class="font-medium text-slate-900">${item.qty}x</span></li>`
				);
			});
			const payload = items.map((item) => ({
				product_id: item.productId,
				quantity: item.qty,
			}));
			itemsInput.value = JSON.stringify(payload);

		};

		document.querySelectorAll('.add-to-cart').forEach((button) => {
			button.addEventListener('click', () => {
				const card = button.closest('.product-card');
				const productId = Number(card.dataset.id);
				const name = card.dataset.name;
				const qtyInput = card.querySelector('.product-qty');
				const qty = Number(qtyInput.value || 0) || 1;
				if (qty <= 0) return;
				const current = cart.get(productId) || { productId, name, qty: 0 };
				current.qty += qty;
				cart.set(productId, current);
				qtyInput.value = 1;
				renderCart();
			});
		});

		cartItems.addEventListener('click', (event) => {
			const target = event.target;
			if (!(target instanceof HTMLElement)) return;
			const id = Number(target.dataset.id);
			if (!id) return;
			const item = cart.get(id);
			if (!item) return;

			if (target.classList.contains('cart-plus')) {
				item.qty += 1;
				cart.set(id, item);
				renderCart();
			}

			if (target.classList.contains('cart-minus')) {
				item.qty = Math.max(1, item.qty - 1);
				cart.set(id, item);
				renderCart();
			}

			if (target.classList.contains('cart-remove')) {
				cart.delete(id);
				renderCart();
			}
		});

		const updateItemsInput = () => {
			const payload = Array.from(cart.values()).map((item) => ({
				product_id: item.productId,
				quantity: item.qty,
			}));
			itemsInput.value = JSON.stringify(payload);
		};

		const form = document.querySelector('form');
		form.addEventListener('submit', () => {
			updateItemsInput();
		});

		rentalStart.addEventListener('change', () => {});
		renderCart();
	</script>
@endsection

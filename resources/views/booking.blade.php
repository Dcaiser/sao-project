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
				<form class="space-y-6">

					<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
						<h2 class="text-lg font-semibold text-slate-900">Periode Peminjaman</h2>
						<p class="text-sm text-slate-500">Pilih tanggal peminjaman.</p>

						<div class="grid gap-4 mt-4 sm:grid-cols-2">
							<div>
								<label class="text-sm font-medium text-slate-700">Tanggal Mulai</label>
								<input id="rental-start" type="date" class="w-full mt-2 rounded-xl border-slate-200" />
							</div>
							<div>
								<label class="text-sm font-medium text-slate-700">Tanggal Selesai</label>
								<input type="date" class="w-full mt-2 rounded-xl border-slate-200" />
							</div>
						</div>
					</div>

					<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
						<h2 class="text-lg font-semibold text-slate-900">Alasan Peminjaman</h2>
						<p class="text-sm text-slate-500">Jelaskan tujuan atau kegiatan yang membutuhkan alat.</p>

						<div class="mt-4">
							<label class="text-sm font-medium text-slate-700" for="loan-reason">Alasan</label>
							<textarea id="loan-reason" rows="4" placeholder="Contoh: untuk persiapan lomba." class="w-full mt-2 rounded-xl border-slate-200"></textarea>
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
								<div class="p-4 border shadow-sm product-card rounded-2xl border-slate-200 bg-white/80" data-name="Bola Futsal Standar" data-price="20000">
									<div class="h-32 rounded-xl bg-slate-100"></div>
									<div class="mt-4">
										<p class="text-sm text-slate-500">Olahraga</p>
										<h3 class="text-base font-semibold text-slate-900">Bola Futsal Standar</h3>
										<p class="mt-2 text-sm text-slate-600">Rp 20.000 / hari</p>
									</div>
									<div class="flex items-center justify-between mt-4">
										<input type="number" min="0" value="0" class="w-20 h-10 text-center rounded-lg product-qty border-slate-200" />
										<button type="button" class="add-to-cart h-10 rounded-lg bg-[#0F2854] px-4 text-xs font-semibold text-white hover:bg-[#0B1F44] transition">Tambah</button>
									</div>
								</div>

								<div class="p-4 border shadow-sm product-card rounded-2xl border-slate-200 bg-white/80" data-name="Gitar Akustik" data-price="45000">
									<div class="h-32 rounded-xl bg-slate-100"></div>
									<div class="mt-4">
										<p class="text-sm text-slate-500">Musik</p>
										<h3 class="text-base font-semibold text-slate-900">Gitar Akustik</h3>
										<p class="mt-2 text-sm text-slate-600">Rp 45.000 / hari</p>
									</div>
									<div class="flex items-center justify-between mt-4">
										<input type="number" min="0" value="0" class="w-20 h-10 text-center rounded-lg product-qty border-slate-200" />
										<button type="button" class="add-to-cart h-10 rounded-lg bg-[#0F2854] px-4 text-xs font-semibold text-white hover:bg-[#0B1F44] transition">Tambah</button>
									</div>
								</div>

								<div class="p-4 border shadow-sm product-card rounded-2xl border-slate-200 bg-white/80" data-name="Tenda Pramuka 4P" data-price="30000">
									<div class="h-32 rounded-xl bg-slate-100"></div>
									<div class="mt-4">
										<p class="text-sm text-slate-500">Pramuka</p>
										<h3 class="text-base font-semibold text-slate-900">Tenda Pramuka 4P</h3>
										<p class="mt-2 text-sm text-slate-600">Rp 30.000 / hari</p>
									</div>
									<div class="flex items-center justify-between mt-4">
										<input type="number" min="0" value="0" class="w-20 h-10 text-center rounded-lg product-qty border-slate-200" />
										<button type="button" class="add-to-cart h-10 rounded-lg bg-[#0F2854] px-4 text-xs font-semibold text-white hover:bg-[#0B1F44] transition">Tambah</button>
									</div>
								</div>
							</div>
							<div class="px-4 py-3 text-sm border border-dashed rounded-xl border-slate-200 text-slate-500">
								Pilih jumlah item langsung dari kartu produk.
							</div>
						</div>
					</div>


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
				return;
			}
			cartItems.innerHTML = '';
			cartSummary.innerHTML = '';

			items.forEach((item) => {
				cartItems.insertAdjacentHTML(
					'beforeend',
					`<div class="flex items-center justify-between"><span>${item.name}</span><span class="font-medium text-slate-900">${item.qty}x</span></div>`
				);
				cartSummary.insertAdjacentHTML(
					'beforeend',
					`<li class="flex items-center justify-between"><span>${item.name}</span><span class="font-medium text-slate-900">${item.qty}x</span></li>`
				);
			});

		};

		document.querySelectorAll('.add-to-cart').forEach((button) => {
			button.addEventListener('click', () => {
				const card = button.closest('.product-card');
				const name = card.dataset.name;
				const price = Number(card.dataset.price || 0);
				const qtyInput = card.querySelector('.product-qty');
				const qty = Number(qtyInput.value || 0);
				if (qty <= 0) return;
				const current = cart.get(name) || { name, price, qty: 0 };
				current.qty += qty;
				cart.set(name, current);
				qtyInput.value = 0;
				renderCart();
			});
		});

		rentalStart.addEventListener('change', () => {});
		renderCart();
	</script>
@endsection

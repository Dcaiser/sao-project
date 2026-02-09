@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('header', 'Manajemen Produk')

@section('content')
	<div class="grid gap-6 lg:grid-cols-[1fr_1.4fr]">
		<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
			<h2 class="text-lg font-semibold text-slate-900">Tambah Produk</h2>
			<p class="text-sm text-slate-500">Input nama, gambar, kategori, dan stok.</p>

			@if (session('status'))
				<div class="mt-4 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
					{{ session('status') }}
				</div>
			@endif

			<form class="mt-4 space-y-4" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div>
					<label class="text-sm font-medium text-slate-700">Nama Produk</label>
					<input type="text" name="name" value="{{ old('name') }}" class="mt-2 w-full rounded-xl border-slate-200" required />
					@error('name')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label class="text-sm font-medium text-slate-700">Gambar (opsional)</label>
					<input type="file" name="image" class="mt-2 w-full rounded-xl border-slate-200 bg-white" />
					@error('image')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label class="text-sm font-medium text-slate-700">Kategori Utama</label>
					<select id="category-parent" class="mt-2 w-full rounded-xl border-slate-200" data-selected="">
						<option value="">Pilih kategori</option>
						@foreach ($categories as $category)
							<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach
					</select>
				</div>

				<div>
					<label class="text-sm font-medium text-slate-700">Subkategori</label>
					<select id="category-child" name="category_id" class="mt-2 w-full rounded-xl border-slate-200" data-selected="">
						<option value="">Pilih subkategori</option>
					</select>
					@error('category_id')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label class="text-sm font-medium text-slate-700">Stok</label>
					<input type="number" name="stock" value="{{ old('stock') }}" min="0" class="mt-2 w-full rounded-xl border-slate-200" required />
					@error('stock')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<button type="submit" class="h-11 w-full rounded-xl bg-[#0F2854] px-6 text-sm font-semibold text-white hover:bg-[#0B1F44] transition">
					Simpan Produk
				</button>
			</form>
		</div>

		<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
			<div class="flex items-center justify-between">
				<h2 class="text-lg font-semibold text-slate-900">Daftar Produk</h2>
				<span class="text-sm text-slate-500">{{ $products->count() }} item</span>
			</div>

			<div class="mt-4 overflow-x-auto">
				<table class="w-full text-left text-sm">
					<thead class="text-xs uppercase text-slate-500">
						<tr>
							<th class="py-3">Nama</th>
							<th class="py-3">Kategori</th>
							<th class="py-3">Stok</th>
							<th class="py-3">Gambar</th>
							<th class="py-3 text-right">Aksi</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-slate-200">
						@forelse ($products as $product)
							<tr>
								<td class="py-3 font-medium text-slate-900">{{ $product->name }}</td>
								<td class="py-3 text-slate-600">
									@if ($product->category && $product->category->parent)
										{{ $product->category->parent->name }} / {{ $product->category->name }}
									@elseif ($product->category)
										{{ $product->category->name }}
									@else
										-
									@endif
								</td>
								<td class="py-3 text-slate-600">{{ $product->stock }}</td>
								<td class="py-3 text-slate-600">
									@if ($product->image)
										<span class="rounded-full bg-emerald-50 px-2 py-1 text-xs text-emerald-700">Ada</span>
									@else
										<span class="rounded-full bg-slate-100 px-2 py-1 text-xs text-slate-500">Tidak</span>
									@endif
								</td>
								<td class="py-3 text-right">
									<a href="{{ route('admin.products.edit', $product) }}" class="rounded-lg border border-[#0F2854]/20 px-3 py-1 text-xs font-semibold text-[#0F2854] hover:bg-[#0F2854]/5">Edit</a>
									<form class="inline" method="POST" action="{{ route('admin.products.destroy', $product) }}">
										@csrf
										@method('DELETE')
										<button type="submit" class="ml-2 rounded-lg bg-rose-500 px-3 py-1 text-xs font-semibold text-white hover:bg-rose-600">Hapus</button>
									</form>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="5" class="py-6 text-center text-slate-500">Belum ada produk.</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script>
		const categories = @json($categories);
		const parentSelect = document.getElementById('category-parent');
		const childSelect = document.getElementById('category-child');
		const selectedParent = parentSelect.dataset.selected;
		const selectedChild = childSelect.dataset.selected;

		const renderChildren = (parentId) => {
			childSelect.innerHTML = '';
			if (!parentId) {
				const option = document.createElement('option');
				option.value = '';
				option.textContent = 'Pilih subkategori';
				childSelect.appendChild(option);
				childSelect.disabled = true;
				return;
			}

			const parent = categories.find((item) => String(item.id) === String(parentId));
			if (!parent || parent.children.length === 0) {
				const option = document.createElement('option');
				option.value = parentId;
				option.textContent = 'Gunakan kategori ini';
				childSelect.appendChild(option);
				childSelect.disabled = false;
				return;
			}

			const placeholder = document.createElement('option');
			placeholder.value = '';
			placeholder.textContent = 'Pilih subkategori';
			childSelect.appendChild(placeholder);

			parent.children.forEach((child) => {
				const option = document.createElement('option');
				option.value = child.id;
				option.textContent = child.name;
				if (selectedChild && String(child.id) === String(selectedChild)) {
					option.selected = true;
				}
				childSelect.appendChild(option);
			});

			childSelect.disabled = false;
		};

		parentSelect.addEventListener('change', () => renderChildren(parentSelect.value));

		if (selectedParent) {
			parentSelect.value = selectedParent;
		}
		renderChildren(parentSelect.value);
	</script>
@endsection

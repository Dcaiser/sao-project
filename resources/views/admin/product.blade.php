@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('header', 'Manajemen Produk')

@section('content')
	<div class="grid gap-6 lg:grid-cols-[1fr_1.4fr]">
		<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
			<h2 class="text-lg font-semibold text-slate-900">Tambah Produk</h2>
			<p class="text-sm text-slate-500">Input nama, gambar, kategori, dan stok.</p>

			@if (session('status'))
				<div class="px-4 py-3 mt-4 text-sm rounded-xl bg-emerald-50 text-emerald-700">
					{{ session('status') }}
				</div>
			@endif

			<form class="mt-4 space-y-4" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div>
					<label class="text-sm font-medium text-slate-700">Nama Produk</label>
					<input type="text" name="name" value="{{ old('name') }}" class="w-full mt-2 rounded-xl border-slate-200" required />
					@error('name')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label class="text-sm font-medium text-slate-700">Gambar (opsional)</label>
					<input type="file" name="image" class="w-full mt-2 bg-white rounded-xl border-slate-200" />
					@error('image')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label class="text-sm font-medium text-slate-700">Kategori</label>
					<select name="category_id" class="w-full mt-2 rounded-xl border-slate-200" required>
						<option value="">Pilih kategori</option>
						@foreach ($categories as $category)
							<option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
						@endforeach
					</select>
					@error('category_id')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label for="notes" class="text-sm font-medium text-slate-700">Catatan (opsional)</label>
					<textarea id="notes" name="notes" rows="3" class="w-full mt-2 rounded-xl border-slate-200">{{ old('notes') }}</textarea>
					@error('notes')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label class="text-sm font-medium text-slate-700">Stok</label>
					<input type="number" name="stock" min="0" value="{{ old('stock') }}" class="w-full mt-2 rounded-xl border-slate-200" required />
					@error('stock')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<button type="submit" class="h-11 w-full rounded-xl bg-[#0F2854] px-6 text-sm font-semibold text-white hover:bg-[#0B1F44] transition">
					Simpan
				</button>
			</form>
		</div>

		<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
			<div class="flex items-center justify-between">
				<h2 class="text-lg font-semibold text-slate-900">Daftar Produk</h2>
				<span class="text-sm text-slate-500">{{ $products->count() }} item</span>
			</div>
			<div class="mt-4 overflow-x-auto">
				<table class="w-full text-sm text-left">
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
									@if ($product->category)
										{{ $product->category->name }}
									@else
										-
									@endif
								</td>
								<td class="py-3 text-slate-600">{{ $product->stock }}</td>
								<td class="py-3">
									@if ($product->image)
										<span class="px-2 py-1 text-xs rounded-full bg-emerald-50 text-emerald-700">Ada</span>
									@else
										<span class="px-2 py-1 text-xs rounded-full bg-slate-100 text-slate-500">Tidak</span>
									@endif
								</td>
								<td class="py-3 text-right">
									<a href="{{ route('admin.products.edit', $product) }}" class="inline-flex rounded-lg border border-[#0F2854] px-3 py-1 text-xs font-semibold text-[#0F2854] hover:bg-[#0F2854]/5">Edit</a>
									<form class="inline" method="POST" action="{{ route('admin.products.destroy', $product) }}">
										@csrf
										@method('DELETE')
										<button type="submit" class="px-3 py-1 ml-2 text-xs font-semibold text-white rounded-lg bg-rose-500 hover:bg-rose-600">Hapus</button>
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

@endsection

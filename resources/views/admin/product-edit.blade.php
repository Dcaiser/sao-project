@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('header', 'Edit Produk')

@section('content')
    <div class="max-w-3xl">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Perbarui Produk</h2>
            <p class="text-sm text-slate-500">Ubah data produk yang dipilih.</p>

            <form class="mt-4 space-y-4" action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm font-medium text-slate-700">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="mt-2 w-full rounded-xl border-slate-200" required />
                    @error('name')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Gambar (opsional)</label>
                    <input type="file" name="image" class="mt-2 w-full rounded-xl border-slate-200 bg-white" />
                    @if ($product->image)
                        <p class="mt-2 text-xs text-slate-500">Gambar saat ini: {{ $product->image }}</p>
                    @endif
                    @error('image')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Kategori</label>
                    <select name="category_id" class="mt-2 w-full rounded-xl border-slate-200" required>
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                <div>
                    <label for="notes" class="text-sm font-medium text-slate-700">Catatan (opsional)</label>
                    <textarea id="notes" name="notes" rows="3" class="mt-2 w-full rounded-xl border-slate-200">{{ old('notes', $product->notes) }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" class="mt-2 w-full rounded-xl border-slate-200" required />
                    @error('stock')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="h-11 rounded-xl bg-[#0F2854] px-6 text-sm font-semibold text-white hover:bg-[#0B1F44] transition">Simpan Perubahan</button>
                    <a href="{{ route('admin.products.index') }}" class="h-11 rounded-xl border border-[#0F2854]/20 px-6 text-sm font-semibold text-[#0F2854] hover:bg-[#0F2854]/5 transition inline-flex items-center">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

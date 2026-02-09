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
+                    @error('image')
+                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
+                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Kategori Utama</label>
                    <select id="category-parent" class="mt-2 w-full rounded-xl border-slate-200" data-selected="{{ $product->category?->parent_id ?? $product->category_id }}">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Subkategori</label>
                    <select id="category-child" name="category_id" class="mt-2 w-full rounded-xl border-slate-200" data-selected="{{ $product->category_id }}">
                        <option value="">Pilih subkategori</option>
                    </select>
                    @error('category_id')
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

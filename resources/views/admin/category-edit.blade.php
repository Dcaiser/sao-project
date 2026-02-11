@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('header', 'Edit Kategori')

@section('content')
	<div class="max-w-3xl">
		<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
			<h2 class="text-lg font-semibold text-slate-900">Perbarui Kategori</h2>
			<p class="text-sm text-slate-500">Ubah nama kategori.</p>

			<form class="mt-4 space-y-4" action="{{ route('admin.categories.update', $category) }}" method="POST">
				@csrf
				@method('PUT')

				<div>
					<label class="text-sm font-medium text-slate-700">Nama Kategori</label>
					<input type="text" name="name" value="{{ old('name', $category->name) }}" class="mt-2 w-full rounded-xl border-slate-200" required />
					@error('name')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<div class="flex gap-3">
					<button type="submit" class="h-11 rounded-xl bg-[#0F2854] px-6 text-sm font-semibold text-white hover:bg-[#0B1F44] transition">Simpan Perubahan</button>
					<a href="{{ route('admin.categories.index') }}" class="inline-flex h-11 items-center rounded-xl border border-[#0F2854]/20 px-6 text-sm font-semibold text-[#0F2854] hover:bg-[#0F2854]/5 transition">Batal</a>
				</div>
			</form>
		</div>
	</div>
@endsection

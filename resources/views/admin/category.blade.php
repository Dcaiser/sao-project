@extends('layouts.admin')

@section('title', 'Manajemen Kategori')
@section('header', 'Manajemen Kategori')

@section('content')
	<div class="grid gap-6 lg:grid-cols-[1fr_1.4fr]">
		<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
			<h2 class="text-lg font-semibold text-slate-900">Tambah Kategori</h2>
			<p class="text-sm text-slate-500">Input nama kategori baru.</p>

			@if (session('status'))
				<div class="mt-4 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
					{{ session('status') }}
				</div>
			@endif

			<form class="mt-4 space-y-4" action="{{ route('admin.categories.store') }}" method="POST">
				@csrf
				<div>
					<label class="text-sm font-medium text-slate-700">Nama Kategori</label>
					<input type="text" name="name" value="{{ old('name') }}" class="mt-2 w-full rounded-xl border-slate-200" required />
					@error('name')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<button type="submit" class="h-11 w-full rounded-xl bg-[#0F2854] px-6 text-sm font-semibold text-white hover:bg-[#0B1F44] transition">
					Simpan
				</button>
			</form>
		</div>

		<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
			<div class="flex items-center justify-between">
				<h2 class="text-lg font-semibold text-slate-900">Daftar Kategori</h2>
				<span class="text-sm text-slate-500">{{ $categories->count() }} item</span>
			</div>
			<div class="mt-4 overflow-x-auto">
				<table class="w-full text-sm text-left">
					<thead class="text-xs uppercase text-slate-500">
						<tr>
							<th class="py-3">Nama</th>
							<th class="py-3 text-right">Aksi</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-slate-200">
						@forelse ($categories as $category)
							<tr>
								<td class="py-3 font-medium text-slate-900">{{ $category->name }}</td>
								<td class="py-3 text-right">
									<a href="{{ route('admin.categories.edit', $category) }}" class="inline-flex rounded-lg border border-[#0F2854] px-3 py-1 text-xs font-semibold text-[#0F2854] hover:bg-[#0F2854]/5">Edit</a>
									<form class="inline" method="POST" action="{{ route('admin.categories.destroy', $category) }}">
										@csrf
										@method('DELETE')
										<button type="submit" class="ml-2 rounded-lg bg-rose-500 px-3 py-1 text-xs font-semibold text-white hover:bg-rose-600">Hapus</button>
									</form>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="2" class="py-6 text-center text-slate-500">Belum ada kategori.</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

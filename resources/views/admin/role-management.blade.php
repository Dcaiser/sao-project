@extends('layouts.admin')

@section('title', 'Manajemen Akun')
@section('header', 'Manajemen Akun & Role')

@section('content')
	<div class="grid gap-6 lg:grid-cols-[1fr_1.6fr]">
		<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
			<h2 class="text-lg font-semibold text-slate-900">Tambah Akun</h2>
			<p class="text-sm text-slate-500">Buat akun baru untuk admin, staff, atau penyewa.</p>

			@if (session('status'))
				<div class="px-4 py-3 mt-4 text-sm rounded-xl bg-emerald-50 text-emerald-700">
					{{ session('status') }}
				</div>
			@endif

			@if ($errors->has('role'))
				<div class="px-4 py-3 mt-4 text-sm rounded-xl bg-rose-50 text-rose-700">
					{{ $errors->first('role') }}
				</div>
			@endif

			@if ($errors->has('delete'))
				<div class="px-4 py-3 mt-4 text-sm rounded-xl bg-rose-50 text-rose-700">
					{{ $errors->first('delete') }}
				</div>
			@endif

			<form class="mt-4 space-y-4" method="POST" action="{{ route('admin.roles.store') }}">
				@csrf
				<div>
					<label class="text-sm font-medium text-slate-700">Nama</label>
					<input type="text" name="name" value="{{ old('name') }}" class="w-full mt-2 rounded-xl border-slate-200" required />
					@error('name')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label class="text-sm font-medium text-slate-700">Email</label>
					<input type="email" name="email" value="{{ old('email') }}" class="w-full mt-2 rounded-xl border-slate-200" required />
					@error('email')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label class="text-sm font-medium text-slate-700">Telepon</label>
					<input type="text" name="phone" value="{{ old('phone') }}" class="w-full mt-2 rounded-xl border-slate-200" required />
					@error('phone')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label class="text-sm font-medium text-slate-700">Role</label>
					<select name="role" class="w-full mt-2 rounded-xl border-slate-200" required>
						<option value="">Pilih role</option>
						<option value="admin" @selected(old('role') === 'admin')>Admin</option>
						<option value="staff" @selected(old('role') === 'staff')>Staff</option>
						<option value="penyewa" @selected(old('role') === 'penyewa')>Penyewa</option>
					</select>
					@error('role')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label class="text-sm font-medium text-slate-700">Password</label>
					<input type="password" name="password" class="w-full mt-2 rounded-xl border-slate-200" required />
					@error('password')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>

				<button type="submit" class="h-11 w-full rounded-xl bg-[#0F2854] px-6 text-sm font-semibold text-white hover:bg-[#0B1F44] transition">
					Simpan Akun
				</button>
			</form>
		</div>

		<div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
			<div class="flex items-start justify-between">
				<div>
					<h2 class="text-lg font-semibold text-slate-900">Daftar Akun</h2>
					<p class="text-sm text-slate-500">Kelola data akun dan role pengguna.</p>
				</div>
				<span class="text-xs text-slate-500">{{ $users->total() }} akun</span>
			</div>

			<div class="mt-5 overflow-x-auto">
				<table class="w-full text-sm text-left">
					<thead class="text-xs uppercase text-slate-500">
						<tr>
							<th class="py-3">Nama</th>
							<th class="py-3">Email</th>
							<th class="py-3">Telepon</th>
							<th class="py-3">Role</th>
							<th class="py-3 text-right">Aksi</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-slate-200">
						@forelse ($users as $user)
							<tr>
								<td class="py-3 font-medium text-slate-900">
									{{ $user->name }}
									@if (auth()->id() === $user->id)
										<span class="ml-2 text-xs text-slate-500">(Anda)</span>
									@endif
								</td>
								<td class="py-3 text-slate-600">{{ $user->email }}</td>
								<td class="py-3 text-slate-600">{{ $user->phone ?? '-' }}</td>
								<td class="py-3">
									<span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-600">
										{{ strtoupper($user->role ?? 'penyewa') }}
									</span>
								</td>
								<td class="py-3 text-right">
									<form class="inline-flex items-center gap-3" method="POST" action="{{ route('admin.roles.update', $user) }}">
										@csrf
										@method('PATCH')
										<select name="role" class="text-sm rounded-xl border-slate-200">
											<option value="admin" @selected($user->role === 'admin')>Admin</option>
											<option value="staff" @selected($user->role === 'staff')>Staff</option>
											<option value="penyewa" @selected($user->role === 'penyewa')>Penyewa</option>
										</select>
										<button type="submit" class="rounded-lg bg-[#0F2854] px-3 py-1 text-xs font-semibold text-white hover:bg-[#0B1F44]">
											Simpan
										</button>
									</form>
									<div class="flex justify-end gap-2 mt-2">
										<a href="{{ route('admin.roles.edit', $user) }}" class="inline-flex rounded-lg border border-[#0F2854] px-3 py-1 text-xs font-semibold text-[#0F2854] hover:bg-[#0F2854]/5">Edit</a>
										<form method="POST" action="{{ route('admin.roles.destroy', $user) }}" onsubmit="return confirm('Hapus akun ini?')">
											@csrf
											@method('DELETE')
											<button type="submit" class="px-3 py-1 text-xs font-semibold text-white rounded-lg bg-rose-500 hover:bg-rose-600">Hapus</button>
										</form>
									</div>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="5" class="py-6 text-center text-slate-500">Belum ada akun.</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>

			<div class="mt-6">
				{{ $users->links() }}
			</div>
		</div>
	</div>
@endsection

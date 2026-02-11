@extends('layouts.admin')

@section('title', 'Edit Akun')
@section('header', 'Edit Akun')

@section('content')
    <div class="max-w-3xl">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Perbarui Akun</h2>
            <p class="text-sm text-slate-500">Ubah data akun yang dipilih.</p>

            @if ($errors->has('role'))
                <div class="mt-4 rounded-xl bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    {{ $errors->first('role') }}
                </div>
            @endif

            <form class="mt-4 space-y-4" method="POST" action="{{ route('admin.roles.update', $user) }}">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm font-medium text-slate-700">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-2 w-full rounded-xl border-slate-200" required />
                    @error('name')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-2 w-full rounded-xl border-slate-200" required />
                    @error('email')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="mt-2 w-full rounded-xl border-slate-200" required />
                    @error('phone')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Role</label>
                    <select name="role" class="mt-2 w-full rounded-xl border-slate-200" required>
                        <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                        <option value="staff" @selected(old('role', $user->role) === 'staff')>Staff</option>
                        <option value="penyewa" @selected(old('role', $user->role) === 'penyewa')>Penyewa</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Password (opsional)</label>
                    <input type="password" name="password" class="mt-2 w-full rounded-xl border-slate-200" />
                    @error('password')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="h-11 rounded-xl bg-[#0F2854] px-6 text-sm font-semibold text-white hover:bg-[#0B1F44] transition">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.roles.index') }}" class="inline-flex h-11 items-center rounded-xl border border-[#0F2854]/20 px-6 text-sm font-semibold text-[#0F2854] hover:bg-[#0F2854]/5 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

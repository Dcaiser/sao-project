@extends('layouts.admin')

@section('title', 'Log Aktivitas')
@section('header', 'Log Aktivitas')

@section('content')
	<div class="bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden">
		<div class="px-6 py-4 border-b border-slate-200">
			<h2 class="text-lg font-semibold text-slate-800">Riwayat Aktivitas Admin</h2>
			<p class="text-sm text-slate-500">Menampilkan data aktivitas terbaru dari sistem.</p>
		</div>

		<div class="overflow-x-auto">
			<table class="min-w-full divide-y divide-slate-200">
				<thead class="bg-slate-50">
					<tr>
						<th class="px-6 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-600">No</th>
						<th class="px-6 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-600">Nama</th>
						<th class="px-6 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-600">Role</th>
						<th class="px-6 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-600">Aktivitas</th>
						<th class="px-6 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-600">Objek</th>
						<th class="px-6 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-600">Waktu</th>
					</tr>
				</thead>
				<tbody class="bg-white divide-y divide-slate-100">
					@forelse ($activities as $activity)
						<tr class="hover:bg-slate-50">
							<td class="px-6 py-4 text-sm text-slate-700">{{ $loop->iteration }}</td>
							<td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $activity->name }}</td>
							<td class="px-6 py-4 text-sm text-slate-700">{{ $activity->role }}</td>
							<td class="px-6 py-4 text-sm text-slate-700">{{ $activity->activity }}</td>
							<td class="px-6 py-4 text-sm text-slate-700">{{ $activity->object }}</td>
							<td class="px-6 py-4 text-sm text-slate-600">
								{{ optional($activity->created_at)->format('d M Y H:i') ?? '-' }}
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="6" class="px-6 py-8 text-sm text-center text-slate-500">
								Belum ada data aktivitas.
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
@endsection

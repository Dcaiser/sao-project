@extends('layouts.template')


@section('content')
<!--hero section-->
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-center bg-no-repeat bg-cover" style="background-image: url('{{ asset('storage/products/tenda.jpg') }}'); filter: blur(3px);"></div>
        <div class="absolute rounded-full -top-20 -left-20 h-72 w-72 bg-white/10 blur-3xl"></div>
        <div class="absolute -bottom-24 right-[-5rem] h-80 w-80 rounded-full bg-white/10 blur-3xl"></div>
        <div class="relative px-6 py-16 sm:py-20 lg:px-12">
            <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-white/80">
                        <span class="w-2 h-2 rounded-full bg-emerald-300"></span>
                        Peminjaman Alat Ekstrakurikuler
                    </div>
                    <h1 class="mt-6 text-4xl font-semibold leading-tight text-white sm:text-5xl">
                        Pinjam alat ekstrakurikuler lengkap, cepat, dan terjadwal rapi.
                    </h1>
                    <p class="mt-5 text-lg text-white/85">
                        Mulai dari perlengkapan pramuka, olahraga, musik, hingga multimedia. Booking mudah, kondisi terawat, jadwal transparan.
                    </p>
                    <div class="flex flex-wrap gap-4 mt-8">
                        <a href="#" class="rounded-xl bg-white px-6 py-3 text-sm font-semibold text-[#0F2854] shadow-lg shadow-black/20 hover:bg-slate-100 transition">
                            Lihat Katalog
                        </a>
                        <a href="#" class="px-6 py-3 text-sm font-semibold text-white transition border rounded-xl border-white/30 hover:bg-white/10">
                            Cara Peminjaman
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-6 mt-10 sm:grid-cols-3">
                        <div>
                            <div class="text-2xl font-semibold text-white">4.9/5</div>
                            <p class="text-xs text-white/70">Rating pelanggan</p>
                        </div>
                        <div>
                            <div class="text-2xl font-semibold text-white">320+</div>
                            <p class="text-xs text-white/70">Peralatan tersedia</p>
                        </div>
                        <div>
                            <div class="text-2xl font-semibold text-white">1 Hari</div>
                            <p class="text-xs text-white/70">Proses verifikasi cepat</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

<!--tentang-->
    <section class="bg-slate-50">
        <div class="px-6 py-16 lg:px-12">
            <div class="grid gap-10 lg:grid-cols-[1fr_1.1fr] lg:items-center">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#0F2854]">Tentang</p>
                    <h2 class="mt-4 text-3xl font-semibold text-slate-900">Solusi peminjaman alat ekstrakurikuler yang praktis</h2>
                    <p class="mt-4 text-slate-600">
                        Kami menyediakan peralatan ekstrakurikuler untuk pramuka, olahraga, musik, dan kegiatan sekolah lainnya. Pilih perlengkapan sesuai kebutuhan, ajukan peminjaman, lalu ambil sesuai jadwal.
                    </p>
                    <div class="mt-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="mt-1 h-2.5 w-2.5 rounded-full bg-[#0F2854]"></div>
                            <div>
                                <p class="font-medium text-slate-900">Peralatan terawat</p>
                                <p class="text-sm text-slate-600">Semua alat dicek dan dirawat sebelum dan sesudah dipakai.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-1 h-2.5 w-2.5 rounded-full bg-[#0F2854]"></div>
                            <div>
                                <p class="font-medium text-slate-900">Jadwal fleksibel</p>
                                <p class="text-sm text-slate-600">Sesuaikan peminjaman dengan jadwal latihan atau lomba.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-1 h-2.5 w-2.5 rounded-full bg-[#0F2854]"></div>
                            <div>
                                <p class="font-medium text-slate-900">Administrasi transparan</p>
                                <p class="text-sm text-slate-600">Syarat dan ketentuan jelas, mudah dipahami.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
                        <p class="text-sm text-slate-500">On-Time Pickup</p>
                        <div class="mt-4 text-3xl font-semibold text-[#0F2854]">96%</div>
                        <p class="mt-2 text-xs text-slate-500">Jadwal tepat waktu</p>
                    </div>
                    <div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200">
                        <p class="text-sm text-slate-500">Alat Siap Pakai</p>
                        <div class="mt-4 text-3xl font-semibold text-[#0F2854]">98%</div>
                        <p class="mt-2 text-xs text-slate-500">Kondisi siap pakai</p>
                    </div>
                    <div class="p-6 bg-white border shadow-sm rounded-2xl border-slate-200 sm:col-span-2">
                        <p class="text-sm text-slate-500">Client Feedback</p>
                        <p class="mt-4 text-base text-slate-700">
                            "Alat ekstranya lengkap dan rapi. Proses pinjam cepat, latihan jadi lebih terarah."
                        </p>
                        <p class="mt-4 text-sm font-medium text-slate-900">Raka Mahendra</p>
                        <p class="text-xs text-slate-500">Pembina Ekstrakurikuler, Bandung</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!--produk-->
    <div class="px-6 py-8 bg-slate-200">
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#0F2854] p-3">Peralatan Ekstrakurikuler</p>
        <div class="mb-6">
            <div class="px-5 py-4 border shadow-sm bg-white/90 backdrop-blur rounded-2xl border-slate-200">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-slate-700" for="search">Search</label>
                        <input id="search" type="text" placeholder="Cari pramuka, olahraga, musik..." class="w-full mt-2 rounded-xl border-slate-200 focus:border-slate-400 focus:ring-slate-200" />
                    </div>
                    <div class="w-full lg:w-56">
                        <label class="block text-sm font-medium text-slate-700" for="category">Category</label>
                        <select id="category" class="w-full mt-2 rounded-xl border-slate-200 focus:border-slate-400 focus:ring-slate-200">
                            <option>Semua</option>
                            <option>Pramuka</option>
                            <option>Olahraga</option>
                            <option>Musik</option>
                            <option>Multimedia</option>
                        </select>
                    </div>
                    <div class="flex gap-3">
                        <button class="h-11 px-5 rounded-xl bg-[#4988C4] text-white font-medium hover:bg-[#0B1F44] transition">Apply</button>
                        <button class="h-11 px-5 rounded-xl border border-[#0F2854]/20 text-[#0F2854] font-medium hover:bg-[#0F2854]/5 transition">Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($products as $produk )

            <a href="#" class="block p-4 bg-white rounded-lg shadow-xs shadow-indigo-100">
                <img alt="" src="{{ asset('storage/' . $produk->image) }}" class="object-cover w-full h-56 rounded-md">
                <div class="mt-2">
                    <dl>
                        <div>
                            <dt class="sr-only">category</dt>
                            <dd class="inline-flex rounded-full bg-[#0F2854]/10 px-3 py-1 text-xs font-semibold text-[#0F2854]">
                                {{ $produk->category?->name ?? '-' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="sr-only">name</dt>
                            <dd class="font-medium">{{ $produk->name }}</dd>
                        </div>
                    </dl>
                    <div class="flex items-center justify-between xt-xs justify">
                        <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                            <svg class="text-indigo-700 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                            </svg>
                            <div class="mt-1.5 sm:mt-0">
                            <p class="text-gray-500">stock</p>
                            <p class="font-medium">{{ $produk->stock }}</p>
                            </div>
                        </div>
                        <div class="">
                            <p class="inline-block px-4 py-2 text-xs font-semibold text-[#0F2854]   ">
                                view details
                            </p>
                        </div>
                    </div>

                </div>
            </a>
            @endforeach
        </div>
    </div>

    <a href="/booking" class="fixed bottom-6 right-6 z-50 inline-flex items-center gap-2 rounded-lg bg-[#4988C4] px-7 py-5 text-lg font-semibold text-white shadow-lg shadow-black/20 hover:bg-[#0B1F44] transition">
        Ajukan Peminjaman+
    </a>

@endsection

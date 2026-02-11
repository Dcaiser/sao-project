<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="flex min-h-screen">
        <aside class="fixed inset-y-0 left-0 w-64 bg-[#0F2854] text-white flex-shrink-0">
            <div class="px-6 py-6 border-b border-white/10">
                <div class="text-lg font-semibold">SAO Admin</div>
                <div class="mt-1 text-xs text-white/70">Management Console</div>
            </div>
            <nav class="px-4 py-6 space-y-2">
                <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 transition rounded-xl {{ request()->is('admin/dashboard') ? 'bg-white/15' : 'hover:bg-white/10' }}">
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a href="/admin/inbox" class="flex items-center gap-3 px-4 py-3 transition rounded-xl {{ request()->is('admin/inbox') ? 'bg-white/15' : 'hover:bg-white/10' }}">
                    <span class="text-sm font-medium">Kotak Masuk</span>
                </a>
                <a href="/admin/booking-status" class="flex items-center gap-3 px-4 py-3 transition rounded-xl {{ request()->is('admin/booking-status') ? 'bg-white/15' : 'hover:bg-white/10' }}">
                    <span class="text-sm font-medium">Booking Status</span>
                </a>
                @if (auth()->check() && auth()->user()->role === 'admin')
                    <a href="/admin/products" class="flex items-center gap-3 px-4 py-3 transition rounded-xl {{ request()->is('admin/products') ? 'bg-white/15' : 'hover:bg-white/10' }}">
                        <span class="text-sm font-medium">Manajemen Produk</span>
                    </a>
                    <a href="/admin/categories" class="flex items-center gap-3 px-4 py-3 transition rounded-xl {{ request()->is('admin/categories') ? 'bg-white/15' : 'hover:bg-white/10' }}">
                        <span class="text-sm font-medium">Manajemen Kategori</span>
                    </a>
                    <a href="/admin/roles" class="flex items-center gap-3 px-4 py-3 transition rounded-xl {{ request()->is('admin/roles') ? 'bg-white/15' : 'hover:bg-white/10' }}">
                        <span class="text-sm font-medium">Manajemen role</span>
                    </a>
                @endif

            </nav>
        </aside>

        <div class="flex flex-col flex-1 ml-64">
            <header class="bg-white border-b border-slate-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h1 class="text-xl font-semibold text-slate-900">@yield('header', 'Dashboard')</h1>
                        <p class="text-sm text-slate-500">Pantau aktivitas rental dan status booking hari ini.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="rounded-xl border border-[#0F2854]/20 px-4 py-2 text-sm font-medium text-[#0F2854] hover:bg-[#0F2854]/5 transition">
                            Export
                        </button>
                        <button class="rounded-xl bg-[#0F2854] px-4 py-2 text-sm font-medium text-white hover:bg-[#0B1F44] transition">
                            Tambah Booking
                        </button>
                    </div>
                </div>
            </header>

            <main class="flex-1 px-6 py-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>

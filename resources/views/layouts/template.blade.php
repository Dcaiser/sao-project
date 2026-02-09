<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="fixed top-0 flex flex-col items-center justify-center w-full z-20  bg-[#0F2854] text-white">
        <div class="mb-4 text-4xl p-4 font-bold h-[20%] uppercase flex justify-between w-full">
            <button class="">
                <svg width="50" height="50" viewBox="0 0 140 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="140" height="22.4579" fill="#EDEDED"/>
                    <rect y="38.457" width="140" height="22.4579" fill="#EDEDED"/>
                    <rect y="76.9141" width="140" height="22.4579" fill="#EDEDED"/>
                    </svg>

            </button>
            <h1 class="">sewa alat ekstrakurikuler</h1>
            <div class="text-white">
                 @if (Route::has('login'))
                 @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-white dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-white border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>
                    @endauth
                 @endif
            </div>
        </div>
            <div class="text-lg p-4 h-[20%] w-full flex items-end justify-evenly overflow-auto capitalize">
                <a class="mb-2" href="">beranda</a>
                <a class="mb-2" href="">tentang</a>
                <a class="mb-2" href="">produk</a>
                <a class="mb-2" href="">kritik & saran</a>


            </div>

        </div>
    <main >
            <div class="mt-40"></div>

        @yield('content')
    </main>

</body>
</html>

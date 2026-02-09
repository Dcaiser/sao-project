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
<div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
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

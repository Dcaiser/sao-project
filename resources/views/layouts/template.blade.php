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
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

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
                    @else
                        <a
                            href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#fff] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold transition rounded-xl bg-white/10 hover:bg-white/20">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
            <div class="flex items-end w-full overflow-auto text-lg capitalize justify-evenly">
                <a class="inline-flex items-center gap-2 mb-2" href="{{ route('home') }}">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 10.5L12 3l9 7.5" />
                        <path d="M5 9.5V21h14V9.5" />
                        <path d="M9 21v-6h6v6" />
                    </svg>
                    Home
                </a>
                <a class="inline-flex items-center gap-2 mb-2" href="{{ route('status') }}">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="9" cy="20" r="1" />
                        <circle cx="18" cy="20" r="1" />
                        <path d="M3 4h2l2.4 12h11.2l2.4-8H6" />
                    </svg>
                    Status Peminjaman
                </a>
            </div>

        </div>
    <main >
            <div class="mt-40"></div>

        @yield('content')
    </main>

</body>
</html>

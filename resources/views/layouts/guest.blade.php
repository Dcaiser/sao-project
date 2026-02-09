<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-white bg-slate-950">
        <div class="flex flex-col min-h-screen lg:flex-row">
            <div class="relative w-full lg:w-[70%] overflow-hidden">

            </div>

            <div class="w-full lg:w-[30%] bg-[#0F2854] flex items-center justify-center px-6 py-12 lg:py-0 shadow-2xl">
                <div class="flex flex-col justify-center w-full max-w-md">
                    <div class="mb-8 text-center">
                        <h2 class="text-2xl font-semibold">Welcome back</h2>
                        <p class="mt-2 text-white/70">Sign in to continue to your dashboard.</p>
                    </div>
                    <div class="px-8 py-8 text-slate-900 rounded-2xl">
                        {{ $slot }}
                    </div>
                    <p class="mt-6 text-xs text-white/60">
                        By continuing, you agree to our Terms and Privacy Policy.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>

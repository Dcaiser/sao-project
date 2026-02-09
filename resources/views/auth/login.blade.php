<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
<div class="w-full px-6 py-4 overflow-hidden bg-blue dark:bg-gray-800 sm:rounded-lg ">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="">
            <x-input-label for="email" :value="__('Email')" class="text-white " />
            <x-text-input id="email" class="block w-full mt-1 bg-transparent border border-white focus:text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white " />

            <x-text-input id="password" class="block w-full mt-1 bg-transparent border border-white focus:text-white "
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center ">
                <input id="remember_me" type="checkbox" class="border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="text-sm text-white ms-2 dark:text-white ">{{ __('Remember me') }}</span>
            </label>

        </div>


        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-white underline rounded-md dark:text-white hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="bg-white ms-3 text-[#0F2854] font-bold">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    <div class="">
        <p class="mt-6 text-sm text-white/60">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-white underline">
                {{ __('Register') }}
            </a>
        </p>
    </div>
</div>
</x-guest-layout>

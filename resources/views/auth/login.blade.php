<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <!-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> -->

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <span class="grid place-items-center mb-3 font-bold text-lg">Welcome!</span>

            <!-- Username -->
            <div>
                <x-label for="Username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <!-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-txt">{{ __('Remember me') }}</span>
                </label>
            </div> -->

            <div class="flex flex-col items-center justify-between mt-14">
                <x-button class="w-full place-content-center">
                    {{ __('Log in') }}
                </x-button>

                @if (Route::has('register'))
                    <a class="mt-3 underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                        {{ __("Don't have an account? Create one here") }}
                    </a>
                @endif
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="max-w-md mx-auto p-8 bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 rounded-xl shadow-lg">
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-white text-lg font-semibold" />
                <x-text-input id="email"
                    class="block mt-2 w-full p-4 rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-purple-500 bg-white text-gray-900"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-white text-lg font-semibold" />
                <x-text-input id="password"
                    class="block mt-2 w-full p-4 rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-purple-500 bg-white text-gray-900"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center text-white">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Forgot Password Link -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="text-sm text-white hover:text-gray-200" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <!-- Login Button -->
                <x-primary-button
                    class="w-auto py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Log in') }}
                </x-primary-button>

            </div>
        </form>
    </div>
</x-guest-layout>
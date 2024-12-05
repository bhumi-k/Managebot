<x-guest-layout class="bg-gradient-to-r from-teal-400 via-indigo-500 to-pink-500 min-h-screen flex items-center justify-center">
    <form method="POST" action="{{ route('register') }}" class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        @csrf

        <!-- Name -->
        <div class="mb-6">
            <x-input-label for="name" :value="__('Name')" class="text-gray-800 font-semibold" />
            <x-text-input id="name" class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
        </div>

        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" class="text-gray-800 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <x-input-label for="password" :value="__('Password')" class="text-gray-800 font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-800 font-semibold" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-teal-600 focus:outline-none" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="py-2 px-4 bg-gradient-to-r from-teal-600 to-indigo-600 text-white rounded-lg hover:bg-gradient-to-l focus:outline-none focus:ring-2 focus:ring-teal-500 w-auto">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

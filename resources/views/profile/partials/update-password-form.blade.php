<section class="space-y-6 bg-white dark:bg-gray-800 p-6 shadow rounded-lg">
    <!-- Header -->
    <header class="border-b border-gray-200 dark:border-gray-700 pb-4">
        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <!-- Form -->
    <form method="Post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

       <!-- Current Password -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
            <x-text-input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                autocomplete="current-password"
                placeholder="Enter your current password"
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
            <x-text-input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                autocomplete="new-password"
                placeholder="Enter your new password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirm New Password -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
            <x-text-input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                autocomplete="new-password"
                placeholder="Confirm your new password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Save Button & Status -->
        <div class="flex items-center justify-between">
            <x-primary-button class="px-6 py-2 text-sm font-semibold">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 font-medium"
                >
                    {{ __('Password updated successfully.') }}
                </p>
            @endif
        </div>
    </form>
</section>

<section class="space-y-6 bg-white dark:bg-gray-800 p-6 shadow rounded-lg">
    <!-- Header -->
    <header class="border-b border-gray-200 dark:border-gray-700 pb-4">
        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Delete Button -->
    <div class="flex justify-start mt-4">
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-6 py-3 text-sm font-semibold"
        >
            {{ __('Delete Account') }}
        </x-danger-button>
    </div>
    @if(session('status'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('status') }}</span>
    </div>
@endif

    <!-- Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="POST" action="{{ route('profile.destroy') }}" class="p-6 space-y-6">
    @csrf
    @method('DELETE')

    <!-- Modal Header -->
    <h2 class="text-lg font-bold text-red-600 dark:text-red-400">
        {{ __('Are you sure you want to delete your account?') }}
    </h2>
    <p class="text-sm text-gray-600 dark:text-gray-400">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
    </p>

    <!-- Password Input -->
    <div class="mt-4">
        <x-input-label for="password" value="{{ __('Password') }}" />
        <x-text-input
            id="password"
            name="password"
            type="password"
            class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-red-500 focus:border-red-500"
            placeholder="{{ __('Enter your password') }}"
            required
        />
        @error('userDeletion.password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Modal Buttons -->
    <div class="mt-6 flex justify-end space-x-3">
        <x-secondary-button 
            type="button"
            x-on:click="$dispatch('close')"
            class="px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-500"
        >
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-danger-button class="px-6 py-2 text-sm font-semibold">
            {{ __('Delete Account') }}
        </x-danger-button>
    </div>
</form>

    </x-modal>
</section>

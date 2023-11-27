<x-modal name="edit-user">
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="form_name"
                :value="__('Name')" />
            <x-text-input wire:model="form.name"
                id="form_name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                required
                autofocus
                autocomplete="name" />
            <x-input-error :messages="$errors->get('form.name')"
                class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="form_email"
                :value="__('Email')" />
            <x-text-input wire:model="form.email"
                id="form_email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                required
                autocomplete="email" />
            <x-input-error :messages="$errors->get('form.email')"
                class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="form_role"
                :value="__('Role')" />
            <select wire:model='form.role'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
            </select>
            <x-input-error :messages="$errors->get('form.role')"
                class="mt-2" />
        </div>

        <div class="flex items-center mb-4">
            <input id="default-checkbox"
                type="checkbox"
                value=""
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="default-checkbox"
                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Reset password</label>
        </div>
        <h1>If checked, a random password will be sent to the user's email</h1>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>

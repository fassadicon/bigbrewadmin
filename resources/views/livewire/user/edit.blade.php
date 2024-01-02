<x-modal name="edit-user">
    <form wire:submit="update" class="p-4">
 
        <div class="mb-4">
            <x-input-label for="form_name" :value="__('Name')" />
            <x-text-input wire:model="form.name" id="form_name" class="block mt-1 w-full" type="text" name="name"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="form_email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="form_email" class="block mt-1 w-full" type="email" name="email"
                required autocomplete="email" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="form_role" :value="__('Role')" />
            <select wire:model='form.role'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="Admin">Admin</option>
                <option value="Super Admin">Super Admin</option>
                <option value="Employee">Employee</option>
            </select>
            <x-input-error :messages="$errors->get('form.role')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>

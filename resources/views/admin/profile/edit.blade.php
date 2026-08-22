<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Admin Profile') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium mb-4">Profile Information</h3>
                <form method="post" action="{{ route('admin.profile.update') }}" class="space-y-4">
                    @csrf
                    @method('patch')
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" class="mt-1 block w-full" :value="old('name', $user->name)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </form>
            </div>

            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium mb-4">Update Password</h3>
                <form method="post" action="{{ route('admin.profile.password') }}" class="space-y-4">
                    @csrf
                    @method('put')
                    <x-text-input name="current_password" type="password" class="block w-full" placeholder="Current password" required />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" />
                    <x-text-input name="password" type="password" class="block w-full" placeholder="New password" required />
                    <x-text-input name="password_confirmation" type="password" class="block w-full" placeholder="Confirm new password" required />
                    <x-input-error :messages="$errors->updatePassword->get('password')" />
                    <x-primary-button>{{ __('Update Password') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-admin-app-layout>

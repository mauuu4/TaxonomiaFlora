<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="user_nombre" class="block mt-1 w-full" type="text" name="user_nombre" :value="old('user_nombre')" required autofocus autocomplete="given-name" />
            <x-input-error :messages="$errors->get('user_nombre')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="lastname" :value="__('Lastname')" />
            <x-text-input id="user_apellido" class="block mt-1 w-full" type="text" name="user_apellido" :value="old('user_apellido')" required autocomplete="family-name" />
            <x-input-error :messages="$errors->get('user_apellido')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="user_telefono" class="block mt-1 w-full" type="tel" name="user_telefono" :value="old('user_telefono')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('user_telefono')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="user_email" class="block mt-1 w-full" type="email" name="user_email" :value="old('user_email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('user_email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="user_password" class="block mt-1 w-full"
                            type="password"
                            name="user_password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('user_password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="user_password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="user_password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('user_password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

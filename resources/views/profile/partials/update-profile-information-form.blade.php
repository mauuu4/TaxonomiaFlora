<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="user_nombre" :value="__('First Name')" />
            <x-text-input id="user_nombre" name="user_nombre" type="text" class="mt-1 block w-full" :value="old('user_nombre', $user->user_nombre)" required autofocus autocomplete="given-name" />
            <x-input-error class="mt-2" :messages="$errors->get('user_nombre')" />
        </div>

        <div>
            <x-input-label for="user_apellido" :value="__('Last Name')" />
            <x-text-input id="user_apellido" name="user_apellido" type="text" class="mt-1 block w-full" :value="old('user_apellido', $user->user_apellido)" required autocomplete="given-name" />
            <x-input-error class="mt-2" :messages="$errors->get('user_apellido')" />
        </div>

        <div>
            <x-input-label for="user_cedula" :value="__('Cedula')" />
            <x-text-input id="user_cedula" name="user_cedula" type="text" class="mt-1 block w-full" :value="old('user_cedula', $user->user_cedula)" required/>
            <x-input-error class="mt-2" :messages="$errors->get('user_cedula')" />
        </div>

        <div>
            <x-input-label for="user_telefono" :value="__('Phone')" />
            <x-text-input id="user_telefono" name="user_telefono" type="tel" class="mt-1 block w-full" :value="old('user_telefono', $user->user_telefono)" required autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('user_telefono')" />
        </div>

        <div>
            <x-input-label for="user_email" :value="__('Email')" />
            <x-text-input id="user_email" name="user_email" type="email" class="mt-1 block w-full" :value="old('user_email', $user->user_email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('user_email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

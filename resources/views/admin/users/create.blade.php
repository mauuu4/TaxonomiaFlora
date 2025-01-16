<x-app-layout :nav="'dashboard'">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nuevo Usuario') }}
        </h2>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                 <!-- Tipo de Usuario -->
                 <div>
                    <x-input-label for="tipus_id" :value="__('Tipo de Usuario')" />
                    <select id="tipus_id" name="tipus_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3" required>
                        <option value="">Seleccione un tipo</option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->tipus_id }}" {{ old('tipus_id') == $tipo->tipus_id ? 'selected' : '' }}>
                                {{ $tipo->tipus_detalles }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('tipus_id')" class="mt-2" />
                </div>

                <!-- Nombre -->
                <div>
                    <x-input-label for="user_nombre" :value="__('Nombre')" />
                    <x-text-input id="user_nombre" class="block mt-1 w-full" type="text" name="user_nombre" :value="old('user_nombre')" required autofocus/>
                    <x-input-error :messages="$errors->get('user_nombre')" class="mt-2" />
                </div>

                <!-- Apellido -->
                <div class="mt-4">
                    <x-input-label for="user_apellido" :value="__('Apellido')" />
                    <x-text-input id="user_apellido" class="block mt-1 w-full" type="text" name="user_apellido" :value="old('user_apellido')" required/>
                    <x-input-error :messages="$errors->get('user_apellido')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="user_email" :value="__('Email')" />
                    <x-text-input id="user_email" class="block mt-1 w-full" type="text" name="user_email" :value="old('user_email')" required/>
                    <x-input-error :messages="$errors->get('user_email')" class="mt-2" />
                </div>

                <!-- Telefono -->
                <div class="mt-4">
                    <x-input-label for="user_telefono" :value="__('Telefono')" />
                    <x-text-input id="user_telefono" class="block mt-1 w-full" type="text" name="user_telefono" :value="old('user_telefono')" required/>
                    <x-input-error :messages="$errors->get('user_telefono')" class="mt-2" />
                </div>

                 <!-- Contraseña -->
                <div class="mt-4">
                    <x-input-label for="user_password" :value="__('Password')" />

                    <x-text-input id="user_password" class="block mt-1 w-full"
                                    type="password"
                                    name="user_password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('user_password')" class="mt-2" />
                </div>            

                <!-- Botones -->
                <div class="flex items-center justify-center mt-4 space-x-1">
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                        {{ __('Cancel') }}
                    </a>
                    <x-primary-button class="ms-4">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

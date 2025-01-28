<x-guest-layout>
    <div x-data="{ showPassword: false, showConfirmPassword: false }">
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div class="text-center space-y-2">
                <h2 class="text-3xl font-bold text-gray-900">Registro</h2>
                <p class="text-gray-600">Crea una cuenta para explorar la taxonomía de la flora</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre -->
                <div class="space-y-2">
                    <x-input-label for="user_nombre" :value="__('Nombre')" class="text-sm font-medium" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="user_nombre" class="block mt-1 w-full pl-10" type="text" name="user_nombre"
                            :value="old('user_nombre')" required placeholder="Introduce tu nombre" />
                    </div>
                    <x-input-error :messages="$errors->get('user_nombre')" class="mt-1" />
                </div>

                <!-- Apellido -->
                <div class="space-y-2">
                    <x-input-label for="user_apellido" :value="__('Apellido')" class="text-sm font-medium" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="user_apellido" class="block mt-1 w-full pl-10" type="text" name="user_apellido"
                            :value="old('user_apellido')" required placeholder="Introduce tu apellido" />
                    </div>
                    <x-input-error :messages="$errors->get('user_apellido')" class="mt-1" />
                </div>

                <!-- Cédula -->
                <div class="space-y-2">
                    <x-input-label for="user_cedula" :value="__('Cédula')" class="text-sm font-medium" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 016 0v2h2V7a5 5 0 00-5-5z" />
                            </svg>
                        </div>
                        <x-text-input id="user_cedula" class="block mt-1 w-full pl-10" type="text" name="user_cedula"
                            :value="old('user_cedula')" required autofocus placeholder="Introduce tu cédula" />
                    </div>
                    <x-input-error :messages="$errors->get('user_cedula')" class="mt-1" />
                </div>

                <!-- Teléfono -->
                <div class="space-y-2">
                    <x-input-label for="user_telefono" :value="__('Teléfono')" class="text-sm font-medium" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                        </div>
                        <x-text-input id="user_telefono" class="block mt-1 w-full pl-10" type="tel" name="user_telefono"
                            :value="old('user_telefono')" required placeholder="Introduce tu teléfono" />
                    </div>
                    <x-input-error :messages="$errors->get('user_telefono')" class="mt-1" />
                </div>

                
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <x-input-label for="user_email" :value="__('Email')" class="text-sm font-medium" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <x-text-input id="user_email" class="block mt-1 w-full pl-10" type="email" name="user_email"
                        :value="old('user_email')" required placeholder="Introduce tu email" />
                </div>
                <x-input-error :messages="$errors->get('user_email')" class="mt-1" />
            </div>

            <!-- Contraseña -->
            <div class="space-y-2">
                <x-input-label for="user_password" :value="__('Contraseña')" class="text-sm font-medium" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-text-input id="user_password" class="block mt-1 w-full pl-10 pr-10"
                        x-bind:type="showPassword ? 'text' : 'password'"
                        name="user_password" required placeholder="Introduce tu contraseña" />
                    <button type="button"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center"
                        @click="showPassword = !showPassword">
                        <svg x-show="!showPassword" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="showPassword" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                            <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                            <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('user_password')" class="mt-1" />
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <x-input-label for="user_password_confirmation" :value="__('Confirmar Contraseña')" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-text-input
                        id="user_password_confirmation"
                        class="block mt-1 w-full pl-10 pr-10"
                        x-bind:type="showConfirmPassword ? 'text' : 'password'"
                        name="user_password_confirmation"
                        required
                        placeholder="Confirma tu contraseña"
                    />
                    <button type="button"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center"
                        @click="showConfirmPassword = !showConfirmPassword">
                        <svg x-show="!showConfirmPassword" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="showConfirmPassword" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                            <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                            <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('user_password_confirmation')" class="mt-2" />
            </div>

            <!-- Botón de registro -->
            <div class="flex items-center justify-between mt-6">
                <a
                    class="text-sm text-green-600 hover:text-green-800 underline"
                    href="{{ route('login') }}"
                >
                    {{ __('¿Ya tienes una cuenta?') }}
                </a>

                <x-primary-button class="bg-green-600 hover:bg-green-700">
                    {{ __('Registrarse') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
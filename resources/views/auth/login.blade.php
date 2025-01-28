<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div x-data="{ showPassword: false }">
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900">Iniciar sesión</h2>
                <p class="mt-2 text-sm text-gray-600">Accede a tu cuenta para explorar la taxonomía de la flora.</p>
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="user_email" :value="__('Email')" />
                <x-text-input
                    id="user_email"
                    class="block mt-1 w-full"
                    type="email"
                    name="user_email"
                    :value="old('user_email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Introduce tu email"
                />
                <x-input-error :messages="$errors->get('user_email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="user_password" :value="__('Password')" />
                <div class="relative">
                    <x-text-input
                        id="user_password"
                        class="block mt-1 w-full"
                        x-bind:type="showPassword ? 'text' : 'password'"
                        name="user_password"
                        required
                        autocomplete="current-password"
                        placeholder="Introduce tu contraseña"
                    />
                    <button
                        type="button"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                        @click="showPassword = !showPassword"
                    >
                        <span x-text="showPassword ? '👁️' : '👁️‍🗨️'" class="text-gray-500"></span>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('user_password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input
                        id="remember_me"
                        type="checkbox"
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                        name="remember"
                    />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a
                        class="text-sm text-green-600 hover:text-green-800 underline"
                        href="{{ route('password.request') }}"
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Botón de inicio de sesión -->
            <div>
                <x-primary-button class="w-full justify-center bg-green-600 hover:bg-green-700">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <!-- Enlace a registro -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">
                    ¿No tienes una cuenta?
                    <a href="{{ route('register') }}" class="text-green-600 hover:text-green-800 underline">
                        {{ __('Register') }}
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>

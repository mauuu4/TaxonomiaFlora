<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        {{-- Reino --}}

        {{-- Familia --}}

        {{-- Genero --}}

        <!-- Nombre Cientifico -->
        <div>
            <x-input-label for="nombre_cientifico" :value="__('Nombre Cientifico')" />
            <x-text-input id="nombre_cientifico" class="block mt-1 w-full" type="text" name="nombre_cientifico" :value="old('nombre_cientifico')" required autofocus/>
            <x-input-error :messages="$errors->get('nombre_cientifico')" class="mt-2" />
        </div>

        <!-- Nombre Comun -->
        <div class="mt-4">
            <x-input-label for="nombre_comun" :value="__('Nombre Comun')" />
            <x-text-input id="nombre_comun" class="block mt-1 w-full" type="text" name="nombre_comun" :value="old('nombre_comun')" required/>
            <x-input-error :messages="$errors->get('nombre_comun')" class="mt-2" />
        </div>

        <!-- Descripcion -->
        <div class="mt-4">
            <x-input-label for="descripcion" :value="__('Descripcion')" />
            <x-text-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" :value="old('descripcion')"/>
            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('especies.index') }}">
                {{ __('Cancel') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

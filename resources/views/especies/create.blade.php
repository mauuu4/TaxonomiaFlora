<x-app-layout :nav="'dashboard'">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Especie') }}
        </h2>
    </x-slot>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-50">
        <div class="w-full max-w-4xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            <form method="POST" action="{{ route('especies.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    @include('especies.partials.form-left-column')
                    @include('especies.partials.form-right-column')
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-center mt-6 space-x-4">
                    <x-secondary-button href="{{ route('especies.index') }}">
                        {{ __('Cancelar') }}
                    </x-secondary-button>
                    <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700 focus:bg-green-700 active:bg-green-700">
                        {{ __('Guardar') }}
                    </x-primary-button>
                </div>
                
            </form>
        </div>
    </div>
</x-app-layout>
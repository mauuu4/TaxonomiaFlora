<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    @foreach ($especies = App\Models\Especie::all() as $especie)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h1>{{ $especie->esp_nombre_comun }}</h1>
                            <p>{{ $especie->esp_nombre_cientifico }}</p>
                            <p>{{ $especie->esp_descripcion }}</p>
                        </div>                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

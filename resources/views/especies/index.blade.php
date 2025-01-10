<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Especies') }}
        </h2>
    </x-slot>

    <a href="{{ route('especies.create') }}">Registrar Especie</a>
    <br>
    <br>

    <ul>
        @foreach ($registros as $registro)
            <li>
                <a href="{{ route('especies.show', $registro->especie->esp_id) }}">
                    {{ $registro->especie->esp_nombre_cientifico }} -
                    {{ $registro->especie->esp_nombre_comun }} 
                </a>
            </li>
        @endforeach
    </ul>

    <div>
        {{ $registros->links() }}
    </div>
</x-app-layout>
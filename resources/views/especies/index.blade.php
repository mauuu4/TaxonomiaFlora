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
        @foreach ($especies as $especie)
            <li>
                <a href="{{ route('especies.show', $especie->esp_id) }}">
                    {{ $especie->esp_nombre_cientifico }} -
                    {{ $especie->esp_nombre_comun }} 
                </a>
            </li>
        @endforeach
    </ul>

    <div>
        {{ $especies->links() }}
    </div>
</x-app-layout>
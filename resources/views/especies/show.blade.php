<x-app-layout>
    <a href="{{ route('especies.index') }}" class="inline-flex items-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-green-800 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 mr-3">
        {{ __('Volver a Especies') }}
    </a>

    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Especie:') }} {{$especie->esp_nombre_cientifico}}
        </h1>
    </x-slot>
    <p>
        {{ __('Nombre Comun:') }} {{$especie->esp_nombre_comun}}
    </p>
    <p>
        {{ __('Descripcion') }} {{$especie->esp_descripcion}}
    </p>
    <p>
        {{ __('Género:') }} {{$especie->genero->gene_nombre}}
    </p>
    <p>
        {{ __('Familia:') }} {{$especie->genero->familia->fam_nombre}}
    </p>
    <p>
        {{ __('Reino:') }} {{$especie->genero->familia->reino->reino_nombre}}
    </p>

    <a href="{{ route('especies.edit', $especie->esp_id) }}" class="inline-flex items-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-green-800 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 mr-3">
        {{ __('Edit') }}
    </a>
    <form action="{{ route('especies.destroy', $especie->esp_id) }}" method="POST">
        @csrf
        @method('DELETE')
        
        <x-danger-button class="ms-4">
            {{ __('Delete') }}
        </x-danger-button>
</x-app-layout>
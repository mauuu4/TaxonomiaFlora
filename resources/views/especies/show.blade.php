<x-app-layout>
    <a href="/especies">Volver a Especies</a>

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
        {{ __('Genero') }} {{$especie->esp_gene_id}}
    </p>
</x-app-layout>
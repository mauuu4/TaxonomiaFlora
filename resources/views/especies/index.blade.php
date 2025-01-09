<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Especies') }}
        </h2>
        <x-alert type="success" class="mb-2">
            <x-slot name='title'>
                Titulo Alerta
            </x-slot>
            Contenido
        </x-alert>
    </x-slot>
</x-app-layout>
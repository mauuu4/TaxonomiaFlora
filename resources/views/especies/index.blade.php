<x-app-layout :nav="'dashboard'">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Especies') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Encabezado y Botón de Registro -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">
                            {{ __('Especies Registradas') }}
                        </h1>
                        <x-secondary-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-especie-modal')" class="bg-green-600 hover:bg-green-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Registrar Especie
                        </x-secondary-button>
                    </div>
                    @if($registros->isEmpty())
                        <div class="flex flex-col items-center justify-center">
                            <p class="text-gray-500 text-lg">No has registrado ninguna especie.</p>
                            <x-secondary-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'create-especie-modal')" class="bg-green-600 hover:bg-green-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Registrar Especie
                            </x-secondary-button>
                        </div>
                    @else                   
                        <!-- Tabla de Especies -->
                        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                            <table class="border-collapse table-auto w-full bg-white">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Reino
                                        </th>
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Familia
                                        </th>
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Género
                                        </th>
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre Científico
                                        </th>
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre Común
                                        </th>
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Estado
                                        </th>
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Comentarios
                                        </th>
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($registros as $registro)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $registro->especie->genero->familia->reino->reino_nombre }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $registro->especie->genero->familia->fam_nombre }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $registro->especie->genero->gene_nombre }}
                                                </div>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $registro->especie->esp_nombre_cientifico }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ $registro->especie->esp_nombre_comun }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $registro->regis_estado === 'Validado' ? 'bg-green-100 text-green-800' : 
                                                    ($registro->regis_estado === 'Rechazado' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                    {{ $registro->regis_estado }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-500">
                                                    @if($registro->validaciones->isNotEmpty())
                                                        <span class="whitespace-normal">
                                                            {{ $registro->validaciones->first()->valid_comentarios }}
                                                        </span>
                                                        @if($registro->validaciones->count() > 1)
                                                            <span class="text-xs text-gray-400 block mt-1">
                                                                ({{ $registro->validaciones->count() }} validaciones en total)
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="text-gray-400 italic">Sin validaciones</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-3">
                                                    <a href="{{ route('especies.show', $registro->especie->esp_id) }}" 
                                                    class="text-indigo-600 hover:text-indigo-900"> Ver
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <!-- Paginación -->
                    <div class="mt-6">
                        {{ $registros->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="create-especie-modal" :show="$errors->isNotEmpty()" focusable maxWidth="4xl">
        <div class="p-10">
            <h2 class="text-lg font-medium text-gray-900 mb-6 text-center">
                {{ __('Registrar Especie') }}
            </h2>
            <form method="POST" action="{{ route('especies.store') }}" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="grid md:grid-cols-2 gap-6">
                    @include('especies.partials.form-left-column')
                    @include('especies.partials.form-right-column')
                </div>
                <div class="flex items-center justify-end mt-6 space-x-4">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancelar') }}
                    </x-secondary-button>
                    <x-primary-button class="bg-green-500 hover:bg-green-700 focus:bg-green-700 active:bg-green-700">
                        {{ __('Guardar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
</x-app-layout>
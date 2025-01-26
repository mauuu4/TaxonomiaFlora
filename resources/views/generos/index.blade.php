<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Géneros Botánicos') }}
            </h2>
            <x-secondary-button x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'create-genero-modal')" class="bg-green-600 hover:bg-green-700 text-white">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Registrar Nuevo Género
            </x-secondary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Familia</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($generos  as $genero )
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $genero->gene_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $genero->gene_nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $genero->familia->fam_nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('generos.edit', $genero) }}" class="text-blue-600 hover:text-blue-900">
                                                Editar
                                            </a>
                                            <form action="{{ route('generos.destroy', $genero) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este genero?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                        No hay géneros registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $generos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="create-genero-modal" :show="$errors->isNotEmpty()">
        <div class="p-10">
            <h2 class="text-lg font-medium text-gray-900 mb-6 text-center">
                {{ __('Registrar nuevo Género Botánico') }}
            </h2>
            <form method="POST" action="{{ route('generos.store') }}" class="mt-4">
                @csrf
                <div class="mb-4">
                    <x-input-label for="gene_nombre" :value="__('Nombre del Género')" />
                    <x-text-input 
                        id="gene_nombre" 
                        name="gene_nombre" 
                        type="text" 
                        class="mt-1 block w-full" 
                        :value="old('gene_nombre')" 
                        required 
                        autofocus
                    />
                    <x-input-error :messages="$errors->get('gene_nombre')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="gene_fam_id" :value="__('Familia')" />
                    <select 
                        name="gene_fam_id" 
                        id="gene_fam_id" 
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        required>
                        <option value="">Selecciona una Familia</option>
                        @foreach($familias as $familia)
                            <option value="{{ $familia->fam_id }}" 
                                    {{ old('gene_fam_id') == $familia->fam_id ? 'selected' : '' }}>
                                {{ $familia->fam_nombre }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('gene_fam_id')" class="mt-2" />
                </div>

                <div class="flex items-center justify-center mt-6 space-x-4">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button class="bg-green-500 hover:bg-green-700 focus:bg-green-700 active:bg-green-700">
                        {{ __('Crear Género') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
</x-app-layout>
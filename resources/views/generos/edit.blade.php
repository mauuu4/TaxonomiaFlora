<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Género Botánico') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('generos.update', $genero) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="gene_nombre" :value="__('Nombre del Género')" />
                            <x-text-input 
                                id="gene_nombre" 
                                name="gene_nombre" 
                                type="text" 
                                class="mt-1 block w-full" 
                                value="{{ old('gene_nombre', $genero->gene_nombre) }}" 
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
                                            {{ old('gene_fam_id', $genero->gene_fam_id) == $familia->fam_id ? 'selected' : '' }}>
                                        {{ $familia->fam_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('gene_fam_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-center mt-6 space-x-4">
                            <x-secondary-button href="{{ route('generos.index') }}">
                                Cancelar
                            </x-secondary-button>
                            <x-primary-button class="bg-blue-500 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-700">
                                {{ __('Actualizar Género') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

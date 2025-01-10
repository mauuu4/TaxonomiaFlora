<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actualizar Especie') }}
        </h2>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('especies.update', $especie->esp_id )}}">
                @csrf
                
                @method('PUT')

                 <!-- Genero -->
                 <div>
                    <x-input-label for="esp_gene_id" :value="__('Género')" />
                    <select id="esp_gene_id" name="esp_gene_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3" required autofocus>
                        <option value="">Seleccione un género</option>
                        @foreach($generos as $genero)
                            <option value="{{ $genero->gene_id }}" {{ old('esp_gene_id', $especie->esp_gene_id) == $genero->gene_id ? 'selected' : '' }}>
                                {{ $genero->gene_nombre }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('esp_gene_id')" class="mt-2" />
                </div>

                <!-- Nombre Cientifico -->
                <div>
                    <x-input-label for="esp_nombre_cientifico" :value="__('Nombre Científico')" />
                    <x-text-input id="esp_nombre_cientifico" class="block mt-1 w-full" type="text" name="esp_nombre_cientifico" :value="old('esp_nombre_cientifico', $especie->esp_nombre_cientifico)" required/>
                    <x-input-error :messages="$errors->get('esp_nombre_cientifico')" class="mt-2" />
                </div>

                <!-- Nombre Comun -->
                <div class="mt-4">
                    <x-input-label for="esp_nombre_comun" :value="__('Nombre Común')" />
                    <x-text-input id="esp_nombre_comun" class="block mt-1 w-full" type="text" name="esp_nombre_comun" :value="old('esp_nombre_comun', $especie->esp_nombre_comun)" required/>
                    <x-input-error :messages="$errors->get('esp_nombre_comun')" class="mt-2" />
                </div>

                <!-- Descripcion -->
                <div class="mt-4">
                    <x-input-label for="esp_descripcion" :value="__('Descripción')" />
                    <textarea id="esp_descripcion" name="esp_descripcion" 
                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="4">{{ old('esp_descripcion', $especie->esp_descripcion) }}</textarea>
                    <x-input-error :messages="$errors->get('esp_descripcion')" class="mt-2" />
                </div>

                <div class="flex items-center justify-center mt-4 space-x-1">
                    <a href="{{ route('especies.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                        {{ __('Cancel') }}
                    </a>
                    <x-primary-button class="ms-4">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout :nav="'dashboard'">
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-50">
        <h2 class="text-2xl font-semibold text-green-600 text-center">
            {{ __('Registrar Nueva Especie') }}
        </h2>
        <div class="w-full max-w-4xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            <form method="POST" action="{{ route('especies.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <!-- Genero -->
                        <div>
                            <x-input-label for="esp_gene_id" :value="__('Género')" class="text-gray-600" />
                            <select id="esp_gene_id" name="esp_gene_id" class="block mt-1 w-full rounded-md border-gray-300 bg-gray-50" required>
                                <option value="">Seleccione un género</option>
                                @foreach($generos as $genero)
                                    <option value="{{ $genero->gene_id }}" {{ old('esp_gene_id') == $genero->gene_id ? 'selected' : '' }}>
                                        {{ $genero->gene_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('esp_gene_id')" class="mt-2" />
                        </div>

                        <!-- Nombre Cientifico -->
                        <div>
                            <x-input-label for="esp_nombre_cientifico" :value="__('Nombre Científico')" class="text-gray-600" />
                            <x-text-input id="esp_nombre_cientifico" class="block mt-1 w-full bg-gray-50" type="text" name="esp_nombre_cientifico" :value="old('esp_nombre_cientifico')" required autofocus/>
                            <x-input-error :messages="$errors->get('esp_nombre_cientifico')" class="mt-2" />
                        </div>

                        <!-- Nombre Comun -->
                        <div>
                            <x-input-label for="esp_nombre_comun" :value="__('Nombre Común')" class="text-gray-600" />
                            <x-text-input id="esp_nombre_comun" class="block mt-1 w-full bg-gray-50" type="text" name="esp_nombre_comun" :value="old('esp_nombre_comun')" required/>
                            <x-input-error :messages="$errors->get('esp_nombre_comun')" class="mt-2" />
                        </div>

                        <!-- Descripcion -->
                        <div>
                            <x-input-label for="esp_descripcion" :value="__('Descripción')" class="text-gray-600" />
                            <textarea id="esp_descripcion" name="esp_descripcion" 
                                class="block mt-1 w-full rounded-md border-gray-300 bg-gray-50"
                                rows="4">{{ old('esp_descripcion', '') }}</textarea>
                            <x-input-error :messages="$errors->get('esp_descripcion')" class="mt-2" />
                        </div>

                        <!-- Imágenes -->
                        <div>
                            <x-input-label :value="__('Imágenes')" class="text-gray-600" />
                            <div id="imageContainer">
                                <div class="image-input mb-3">
                                    <input type="file" name="imagenes[]" accept="image/*" class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-gray-50 file:text-gray-700
                                        hover:file:bg-gray-100" required
                                    />
                                    <textarea name="img_descripcion[]" placeholder="Descripción de la imagen" 
                                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50"
                                        rows="2"></textarea>
                                </div>
                            </div>
                            <button type="button" onclick="addImageInput()" class="mt-2 px-4 py-1.5 bg-green-500 text-white text-sm rounded-md hover:bg-green-600">
                                Agregar otra imagen
                            </button>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <!-- Ubicación -->
                        <div>
                            <x-input-label :value="__('Ubicación')" class="text-gray-600 font-bold mb-2"/>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="ubi_latitud" :value="__('Latitud')" class="text-gray-600" />
                                    <x-text-input id="ubi_latitud" type="number" name="ubi_latitud" step="any" 
                                        :value="old('ubi_latitud')" required class="mt-1 block w-full bg-gray-50" />
                                    <x-input-error :messages="$errors->get('ubi_latitud')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="ubi_longitud" :value="__('Longitud')" class="text-gray-600" />
                                    <x-text-input id="ubi_longitud" type="number" name="ubi_longitud" step="any" 
                                        :value="old('ubi_longitud')" required class="mt-1 block w-full bg-gray-50" />
                                    <x-input-error :messages="$errors->get('ubi_longitud')" class="mt-2" />
                                </div>
                            </div>

                            <button type="button" class="w-full mt-4 py-1.5 px-4 bg-green-500 text-white text-sm rounded-md hover:bg-green-600">
                                Mostrar en el Mapa
                            </button>

                            <div class="mt-2 h-64 bg-gray-100 rounded-lg border border-gray-200">
                                <div id="map" class="h-full rounded-lg"></div>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="ubi_region" :value="__('Región')" class="text-gray-600" />
                                <x-text-input id="ubi_region" type="text" name="ubi_region" 
                                    :value="old('ubi_region')" required class="mt-1 block w-full bg-gray-50" />
                                <x-input-error :messages="$errors->get('ubi_region')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="ubi_descripcion" :value="__('Descripción de la ubicación')" class="text-gray-600" />
                                <textarea id="ubi_descripcion" name="ubi_descripcion" 
                                    class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50"
                                    rows="3">{{ old('ubi_descripcion') }}</textarea>
                                <x-input-error :messages="$errors->get('ubi_descripcion')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-center mt-6 space-x-4">
                    <a href="{{ route('especies.index') }}" class="px-4 py-1.5 bg-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-400">
                        {{ __('Cancelar') }}
                    </a>
                    <button type="submit" class="px-4 py-1.5 bg-green-500 text-white text-sm rounded-md hover:bg-green-600">
                        {{ __('Guardar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addImageInput() {
            const container = document.getElementById('imageContainer');
            const newInput = document.createElement('div');
            newInput.className = 'image-input mb-3';
            newInput.innerHTML = `
                <input type="file" name="imagenes[]" accept="image/*" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-gray-50 file:text-gray-700
                    hover:file:bg-gray-100" required
                />
                <textarea name="img_descripcion[]" placeholder="Descripción de la imagen" 
                    class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50"
                    rows="2"></textarea>
                <button type="button" onclick="this.parentElement.remove()" 
                    class="mt-2 px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-xs">
                    Eliminar
                </button>
            `;
            container.appendChild(newInput);
        }
    </script>
</x-app-layout>
<x-app-layout :nav="'dashboard'">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Especie') }}: {{ $especie->esp_nombre_cientifico }}
        </h2>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('especies.update', $especie->esp_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Género -->
                <div>
                    <x-input-label for="esp_gene_id" :value="__('Género')" />
                    <select id="esp_gene_id" name="esp_gene_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3" required>
                        @foreach($generos as $genero)
                            <option value="{{ $genero->gene_id }}" {{ old('esp_gene_id', $especie->esp_gene_id) == $genero->gene_id ? 'selected' : '' }}>
                                {{ $genero->gene_nombre }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('esp_gene_id')" class="mt-2" />
                </div>

                <!-- Nombre Científico -->
                <div class="mt-4">
                    <x-input-label for="esp_nombre_cientifico" :value="__('Nombre Científico')" />
                    <x-text-input id="esp_nombre_cientifico" class="block mt-1 w-full" type="text" 
                        name="esp_nombre_cientifico" :value="old('esp_nombre_cientifico', $especie->esp_nombre_cientifico)" required />
                    <x-input-error :messages="$errors->get('esp_nombre_cientifico')" class="mt-2" />
                </div>

                <!-- Nombre Común -->
                <div class="mt-4">
                    <x-input-label for="esp_nombre_comun" :value="__('Nombre Común')" />
                    <x-text-input id="esp_nombre_comun" class="block mt-1 w-full" type="text" 
                        name="esp_nombre_comun" :value="old('esp_nombre_comun', $especie->esp_nombre_comun)" required />
                    <x-input-error :messages="$errors->get('esp_nombre_comun')" class="mt-2" />
                </div>

                <!-- Descripción -->
                <div class="mt-4">
                    <x-input-label for="esp_descripcion" :value="__('Descripción')" />
                    <textarea id="esp_descripcion" name="esp_descripcion" 
                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        rows="4">{{ old('esp_descripcion', $especie->esp_descripcion) }}</textarea>
                    <x-input-error :messages="$errors->get('esp_descripcion')" class="mt-2" />
                </div>

                <!-- Imágenes Actuales -->
                @if($especie->imagenes && $especie->imagenes->count() > 0)
                    <div class="mt-4">
                        <h3 class="font-medium text-gray-700 mb-2">Imágenes Actuales</h3>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($especie->imagenes as $imagen)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $imagen->img_ruta) }}" 
                                         alt="Imagen de especie" 
                                         class="w-full h-32 object-cover rounded">
                                    <input type="hidden" name="imagenes_existentes[]" value="{{ $imagen->img_id }}">
                                    <button type="button" 
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600"
                                            onclick="eliminarImagen(this, {{ $imagen->img_id }})">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Nuevas Imágenes -->
                <div class="mt-4">
                    <x-input-label :value="__('Agregar Nuevas Imágenes')" />
                    <div id="imageContainer">
                        <div class="image-input mb-3">
                            <input type="file" name="nuevas_imagenes[]" accept="image/*" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100"
                            />
                            <textarea name="nuevas_img_descripcion[]" placeholder="Descripción de la imagen" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                rows="2"></textarea>
                        </div>
                    </div>
                    <button type="button" onclick="addImageInput()" class="mt-2 px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">
                        Agregar otra imagen
                    </button>
                </div>

                <!-- Ubicación -->
                @if($especie->ubicaciones->first())
                    <div class="mt-4">
                        <x-input-label :value="__('Ubicación')" class="font-bold mb-2"/>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="ubi_latitud" :value="__('Latitud')" />
                                <x-text-input id="ubi_latitud" type="number" name="ubi_latitud" step="any" 
                                    :value="old('ubi_latitud', $especie->ubicaciones->first()->ubi_latitud)" 
                                    required class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('ubi_latitud')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="ubi_longitud" :value="__('Longitud')" />
                                <x-text-input id="ubi_longitud" type="number" name="ubi_longitud" step="any" 
                                    :value="old('ubi_longitud', $especie->ubicaciones->first()->ubi_longitud)" 
                                    required class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('ubi_longitud')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="ubi_region" :value="__('Región')" />
                            <x-text-input id="ubi_region" type="text" name="ubi_region" 
                                :value="old('ubi_region', $especie->ubicaciones->first()->ubi_region)" 
                                required class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('ubi_region')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="ubi_descripcion" :value="__('Descripción de la ubicación')" />
                            <textarea id="ubi_descripcion" name="ubi_descripcion" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                rows="3">{{ old('ubi_descripcion', $especie->ubicaciones->first()->ubi_descripcion) }}</textarea>
                            <x-input-error :messages="$errors->get('ubi_descripcion')" class="mt-2" />
                        </div>
                    </div>
                @endif

                <!-- Botones -->
                <div class="flex items-center justify-end mt-4 space-x-4">
                    <a href="{{ route('especies.show', $especie->esp_id) }}" 
                        class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                    <x-primary-button>
                        {{ __('Actualizar') }}
                    </x-primary-button>
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
                <input type="file" name="nuevas_imagenes[]" accept="image/*" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-700
                    hover:file:bg-indigo-100"
                />
                <textarea name="nuevas_img_descripcion[]" placeholder="Descripción de la imagen" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    rows="2"></textarea>
                <button type="button" onclick="this.parentElement.remove()" 
                    class="mt-2 px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-xs">
                    Eliminar
                </button>
            `;
            container.appendChild(newInput);
        }

        // Array para mantener registro de las imágenes a eliminar
        let imagenesToDelete = [];

        function eliminarImagen(button, imageId) {
            // Agregar el ID de la imagen al array de imágenes a eliminar
            imagenesToDelete.push(imageId);
            
            // Crear un input hidden para enviar los IDs de las imágenes a eliminar
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'imagenes_eliminar[]';
            input.value = imageId;
            document.querySelector('form').appendChild(input);

            // Eliminar visualmente la imagen
            button.closest('.relative').remove();
        }
    </script>
</x-app-layout>
<x-app-layout>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-50">
        <div class="w-full max-w-4xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            <form method="POST" action="{{ route('especies.update', $especie->esp_id) }}" enctype="multipart/form-data" class="mt-4">
                @csrf
                @method('PUT')

                <h2 class="text-lg font-medium text-gray-900 mb-6 text-center">
                    {{ __('Editar Especie:') }} {{ $especie->esp_nombre_cientifico }}
                </h2>
                <div class="mb-4 text-sm text-gray-600">
                    <p><strong>*</strong> Los campos marcados con asterisco son obligatorios.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4" x-data="{
                        genre: '{{ old('esp_gene_id', $especie->esp_gene_id) }}',
                        epithet: '{{ old('epiteto', substr($especie->esp_nombre_cientifico, strpos($especie->esp_nombre_cientifico, ' ') + 1 ?? '')) }}',
                        genreName: '',
                        scientificName: '{{ old('esp_nombre_cientifico', $especie->esp_nombre_cientifico) }}',
                        updateScientificName() {
                            const selectedOption = document.querySelector(`#esp_gene_id option[value='${this.genre}']`);
                            this.genreName = selectedOption && this.genre !== '' ? selectedOption.text : '';
                            
                            if (this.genreName && this.genreName !== 'Seleccione un género' && this.epithet) {
                                this.scientificName = `${this.genreName} ${this.epithet}`;
                            } else {
                                this.scientificName = '';
                            }
                        }
                    }">
                        <!-- Género -->
                        <div>
                            <x-input-label for="esp_gene_id" :value="__('Género *')" class="text-gray-950" />
                            <select 
                                id="esp_gene_id" 
                                name="esp_gene_id" 
                                x-model="genre"
                                @change="updateScientificName()"
                                class="block mt-1 w-full rounded-md border-gray-300 py-2 px-3" 
                                required 
                                autofocus
                            >
                                <option value="">Seleccione un género</option>
                                @foreach($generos as $genero)
                                    <option value="{{ $genero->gene_id }}" {{ old('esp_gene_id', $especie->esp_gene_id) == $genero->gene_id ? 'selected' : '' }}>
                                        {{ $genero->gene_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('esp_gene_id')" class="mt-2" />
                        </div>
                    
                        <!-- Epíteto -->
                        <div>
                            <x-input-label for="epiteto" :value="__('Epíteto Específico *')" class="text-gray-950" />
                            <x-text-input 
                                id="epiteto" 
                                class="block mt-1 w-full" 
                                type="text" 
                                name="epiteto" 
                                x-model="epithet"
                                @input="updateScientificName()"
                                :value="old('epiteto', substr($especie->esp_nombre_cientifico, strpos($especie->esp_nombre_cientifico, ' ') + 1 ?? ''))" 
                                placeholder="Ej: officinale"
                                required
                            />
                            <x-input-error :messages="$errors->get('epiteto')" class="mt-2" />
                        </div>
                    
                        <div>
                            <x-input-label :value="__('Nombre Científico')" class="text-gray-950" />
                            <div 
                                x-text="scientificName || 'El nombre científico se genera automáticamente: Género + epíteto'"
                                :class="scientificName 
                                    ? 'block mt-1 w-full rounded-md border-gray-300 bg-gray-100 py-3 px-3' 
                                    : 'block mt-1 w-full rounded-md border-gray-300 bg-gray-50 py-3 px-3 text-gray-500 italic'"
                            ></div>
                            <small x-show="scientificName" class="text-gray-600 mt-1 block">
                                Se genera automáticamente combinando el Género y el Epíteto
                            </small>
                            <input 
                                type="hidden" 
                                name="esp_nombre_cientifico" 
                                :value="scientificName"
                            />
                        </div>

                        <!-- Nombre Común -->
                        <div>
                            <x-input-label for="esp_nombre_comun" :value="__('Nombre Común *')" class="text-gray-950" />
                            <x-text-input 
                            id="esp_nombre_comun" 
                            class="block mt-1 w-full" 
                            type="text" 
                            name="esp_nombre_comun" 
                            :value="old('esp_nombre_comun', $especie->esp_nombre_comun)" 
                            placeholder="Ej: Diente de león"
                            required />
                            <x-input-error :messages="$errors->get('esp_nombre_comun')" class="mt-2" />
                        </div>
                        <!-- Descripción -->
                        <div>
                            <x-input-label for="esp_descripcion" :value="__('Descripción *')" class="text-gray-950" />
                            <textarea 
                                id="esp_descripcion" 
                                name="esp_descripcion" 
                                class="block mt-1 w-full rounded-md border-gray-300"
                                rows="3"
                                placeholder="Ej: Planta herbácea perenne muy común en prados y jardines..."
                                required
                                >{{ old('esp_descripcion', $especie->esp_descripcion) }}</textarea>
                            <x-input-error :messages="$errors->get('esp_descripcion')" class="mt-2" />
                        </div>

                        <!-- Imágenes Actuales -->
                        @if($especie->imagenes && $especie->imagenes->count() > 0)
                            <div class="mt-4">
                                <x-input-label :value="__('Imágenes Actuales')" class="text-gray-950" />
                                <p class="text-sm text-gray-600 mb-2">Marque las casillas para eliminar imágenes. Debe mantener al menos una imagen.</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                                    @foreach($especie->imagenes as $imagen)
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $imagen->img_ruta) }}" 
                                                alt="Imagen de {{ $especie->esp_nombre_cientifico }}" 
                                                class="rounded-lg shadow-md w-full h-32 object-cover">
                                            
                                            <!-- Checkbox para eliminar la imagen -->
                                            <div class="absolute top-2 right-2">
                                                <input 
                                                    type="checkbox" 
                                                    name="imagenes_eliminar[]" 
                                                    value="{{ $imagen->img_id }}" 
                                                    class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                            </div>
                                            <div class="mt-2">
                                                <input 
                                                    type="text" 
                                                    name="img_descripcion_nueva[{{ $imagen->img_id }}]" 
                                                    value="{{ $imagen->img_descripcion }}" 
                                                    placeholder="Descripción de la imagen" 
                                                    class="block w-full text-sm border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                >
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Nuevas Imágenes -->
                        <x-image-uploader 
                            name="nuevas_imagenes" 
                            label="Agregar nuevas imágenes" 
                            :maxImages="5 - $especie->imagenes->count()"
                        />

                    </div>
                    
                    <!-- Right Column -->
                    <div class="space-y-4">
                        <!-- Ubicación -->
                        @if($ubicacion = $especie->ubicaciones->first())
                            <div>
                                <x-input-label :value="__('Ubicación')" class="text-gray-950 font-bold mb-2"/>
                                <x-map-location :lat="$ubicacion->ubi_latitud" :lng="$ubicacion->ubi_longitud" />
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <x-input-label for="ubi_latitud" :value="__('Latitud *')" class="text-gray-950" />
                                        <x-text-input 
                                            id="ubi_latitud" 
                                            type="number" 
                                            name="ubi_latitud" 
                                            step="0.00001" 
                                            :value="old('ubi_latitud', $ubicacion->ubi_latitud)" 
                                            required 
                                            class="mt-1 block w-full bg-gray-50" 
                                            placeholder="Ej: 0.35836"
                                            oninput="this.value = parseFloat(this.value).toFixed(5)"
                                        />
                                        <x-input-error :messages="$errors->get('ubi_latitud')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="ubi_longitud" :value="__('Longitud *')" class="text-gray-950" />
                                        <x-text-input 
                                            id="ubi_longitud" 
                                            type="number" 
                                            name="ubi_longitud" 
                                            step="0.00001" 
                                            :value="old('ubi_longitud', $ubicacion->ubi_longitud)" 
                                            required 
                                            class="mt-1 block w-full bg-gray-50" 
                                            placeholder="Ej: -78.11147"
                                            oninput="this.value = parseFloat(this.value).toFixed(5)"
                                        />
                                        <x-input-error :messages="$errors->get('ubi_longitud')" class="mt-2" />
                                    </div>
                                </div>
        
                                <div class="mt-4">
                                    <x-input-label for="ubi_region" :value="__('Región *')" class="text-gray-950" />
                                    <select 
                                        id="ubi_region" 
                                        name="ubi_region" 
                                        required 
                                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 focus:border-green-500 focus:ring-green-500"
                                    >
                                        <option value="" disabled>Seleccione una región</option>
                                        <option value="Sierra" {{ old('ubi_region', $ubicacion->ubi_region) == 'Sierra' ? 'selected' : '' }}>Sierra</option>
                                        <option value="Costa" {{ old('ubi_region', $ubicacion->ubi_region) == 'Costa' ? 'selected' : '' }}>Costa</option>
                                        <option value="Amazonía" {{ old('ubi_region', $ubicacion->ubi_region) == 'Amazonía' ? 'selected' : '' }}>Amazonía</option>
                                        <option value="Galápagos" {{ old('ubi_region', $ubicacion->ubi_region) == 'Galápagos' ? 'selected' : '' }}>Región Insular (Galápagos)</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('ubi_region')" class="mt-2" />
                                </div>
        
                                <div class="mt-4">
                                    <x-input-label for="ubi_descripcion" :value="__('Descripción de la ubicación (Opcional)')" class="text-gray-950" />
                                    <textarea 
                                        id="ubi_descripcion" 
                                        name="ubi_descripcion" 
                                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50"
                                        rows="2" 
                                        placeholder="Ej: Zona montañosa cercana al río, altitud 2800 msnm..."
                                    >{{ old('ubi_descripcion', $ubicacion->ubi_descripcion) }}</textarea>
                                    <x-input-error :messages="$errors->get('ubi_descripcion')" class="mt-2" />
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-center mt-6 space-x-4">
                    <x-secondary-button href="{{ route('especies.show', $especie->esp_id) }}">
                        {{ __('Cancelar') }}
                    </x-secondary-button>
                    <x-primary-button class="bg-green-500 hover:bg-green-700 focus:bg-green-700 active:bg-green-700">
                        {{ __('Actualizar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
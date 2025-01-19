<!-- Left Column -->
<div class="space-y-4">
    <!-- Genero -->
    <div>
        <x-input-label for="esp_gene_id" :value="__('Género')" class="text-gray-600" />
        <select id="esp_gene_id" name="esp_gene_id" class="block mt-1 w-full rounded-md border-gray-300  py-2 px-3" required autofocus>
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
        <x-text-input id="esp_nombre_cientifico" class="block mt-1 w-full " type="text" name="esp_nombre_cientifico" :value="old('esp_nombre_cientifico')" required/>
        <x-input-error :messages="$errors->get('esp_nombre_cientifico')" class="mt-2" />
    </div>

    <!-- Nombre Comun -->
    <div>
        <x-input-label for="esp_nombre_comun" :value="__('Nombre Común')" class="text-gray-600" />
        <x-text-input id="esp_nombre_comun" class="block mt-1 w-full " type="text" name="esp_nombre_comun" :value="old('esp_nombre_comun')" required/>
        <x-input-error :messages="$errors->get('esp_nombre_comun')" class="mt-2" />
    </div>

    <!-- Descripcion -->
    <div>
        <x-input-label for="esp_descripcion" :value="__('Descripción')" class="text-gray-600" />
        <textarea id="esp_descripcion" name="esp_descripcion" 
            class="block mt-1 w-full rounded-md border-gray-300"
            rows="4">{{ old('esp_descripcion', '') }}</textarea>
        <x-input-error :messages="$errors->get('esp_descripcion')" class="mt-2" />
    </div>

    <!-- Imágenes -->
    <x-image-uploader 
    name="esp_imagenes" 
    label="Imágenes" 
    :maxImages="5"
    />
</div>
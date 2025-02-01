<!-- Left Column -->
<div class="space-y-4" x-data="{
        genre: '{{ old('esp_gene_id', '') }}',
        epithet: '{{ old('epiteto', '') }}',
        genreName: '',
        scientificName: '',
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
    <!-- Genero -->
    <div>
        <x-input-label for="esp_gene_id" :value="__('Género *')" class="text-gray-600" />
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
                <option value="{{ $genero->gene_id }}" {{ old('esp_gene_id') == $genero->gene_id ? 'selected' : '' }}>
                    {{ $genero->gene_nombre }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('esp_gene_id')" class="mt-2" />
    </div>

    <!-- Epíteto -->
    <div>
        <x-input-label for="epiteto" :value="__('Epíteto *')" class="text-gray-600" />
        <x-text-input 
            id="epiteto" 
            class="block mt-1 w-full" 
            type="text" 
            name="epiteto" 
            x-model="epithet"
            @input="updateScientificName()"
            :value="old('epiteto')" 
            required
        />
        <x-input-error :messages="$errors->get('epiteto')" class="mt-2" />
    </div>

    <div>
        <x-input-label :value="__('Nombre Científico')" class="text-gray-600" />
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

    <!-- Nombre Comun -->
    <div>
        <x-input-label for="esp_nombre_comun" :value="__('Nombre Común *')" class="text-gray-600" />
        <x-text-input id="esp_nombre_comun" class="block mt-1 w-full " type="text" name="esp_nombre_comun" :value="old('esp_nombre_comun')" required/>
        <x-input-error :messages="$errors->get('esp_nombre_comun')" class="mt-2" />
    </div>

    <!-- Descripcion -->
    <div>
        <x-input-label for="esp_descripcion" :value="__('Descripción *')" class="text-gray-600" />
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
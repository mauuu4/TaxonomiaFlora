<!-- Left Column -->
<div class="space-y-4" x-data="{
    genre: '{{ old('esp_gene_id', '') }}',
    epithet: '{{ old('epiteto', '') }}',
    genreName: '',
    scientificName: '',
    search: '',
    isOpen: false,
    filteredGeneros: [],
    allGeneros: @js($generos),
    
    init() {
        this.filteredGeneros = this.allGeneros;
        this.updateGenreName();
    },
    
    filterGeneros() {
        if (!this.search) {
            this.filteredGeneros = this.allGeneros;
        } else {
            this.filteredGeneros = this.allGeneros.filter(genero => 
                genero.gene_nombre.toLowerCase().includes(this.search.toLowerCase())
            );
        }
    },
    
    selectGenero(generoId, generoNombre) {
        this.genre = generoId;
        this.genreName = generoNombre;
        this.search = generoNombre;
        this.isOpen = false;
        this.updateScientificName();
    },
    
    updateGenreName() {
        const selectedGenero = this.allGeneros.find(g => g.gene_id === this.genre);
        this.genreName = selectedGenero ? selectedGenero.gene_nombre : '';
        this.search = this.genreName;
    },
    
    updateScientificName() {
        if (this.genreName && this.genreName !== 'Seleccione un género' && this.epithet) {
            this.scientificName = `${this.genreName} ${this.epithet}`;
        } else {
            this.scientificName = '';
        }
    }
}">
    <!-- Género -->
    <div class="relative">
        <x-input-label for="esp_gene_id" :value="__('Género *')" class="text-gray-950" />
        
        <!-- Input de búsqueda -->
        <div class="relative">
            <input
                type="text"
                x-model="search"
                @click="isOpen = true"
                @input="filterGeneros(); isOpen = true"
                placeholder="Buscar género..."
                class="block mt-1 w-full rounded-md border-gray-300 py-2 px-3"
            >
            
            <!-- Lista desplegable de resultados -->
            <div
                x-show="isOpen"
                @click.outside="isOpen = false"
                class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg"
                style="display: none;"
            >
                <ul class="max-h-60 overflow-y-auto py-1">
                    <template x-for="genero in filteredGeneros" :key="genero.gene_id">
                        <li
                            @mousedown.prevent="selectGenero(genero.gene_id, genero.gene_nombre)"
                            class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                            x-text="genero.gene_nombre"
                        ></li>
                    </template>
                    <li x-show="filteredGeneros.length === 0" class="px-4 py-2 text-gray-500">
                        No se encontraron resultados
                    </li>
                </ul>
            </div>
        </div>

        <!-- Input oculto para enviar el valor seleccionado -->
        <input type="hidden" name="esp_gene_id" x-model="genre" required>
        
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
            :value="old('epiteto')" 
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
                ? 'block mt-1 w-full rounded-md border-gray-300 bg-gray-100 py-3 px-3 italic' 
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
        <x-input-label for="esp_nombre_comun" :value="__('Nombre Común *')" class="text-gray-950" />
        <x-text-input id="esp_nombre_comun" class="block mt-1 w-full " type="text" name="esp_nombre_comun" :value="old('esp_nombre_comun')" placeholder="Ej: Diente de león" required/>
        <x-input-error :messages="$errors->get('esp_nombre_comun')" class="mt-2" />
    </div>

    <!-- Descripcion -->
    <div>
        <x-input-label for="esp_descripcion" :value="__('Descripción *')" class="text-gray-950" />
        <textarea id="esp_descripcion" name="esp_descripcion" 
            class="block mt-1 w-full rounded-md border-gray-300"
            rows="2" placeholder="Ej: Planta herbácea perenne muy común en prados y jardines..."
            required >{{ old('esp_descripcion', '') }}</textarea>
        <x-input-error :messages="$errors->get('esp_descripcion')" class="mt-2" />
    </div>

    <!-- Imágenes -->
    <x-image-uploader 
    name="esp_imagenes" 
    label="Imágenes" 
    :maxImages="5"
    />
</div>
<div class="space-y-4">
    <div>
        <div>
            <x-input-label :value="__('Ubicación *')" class="text-gray-950 font-bold"/>
            <label class="block text-sm text-gray-600">Seleccione la ubicación de la especie en el mapa.</label>

            <div class="mb-4">
                <x-map-location :lat="0.35836" :lng="-78.11147" />
            </div>

            <div class="grid grid-cols-2 gap-4 mt-5">
                <div>
                    <x-input-label for="ubi_latitud" :value="__('Latitud *')" class="text-gray-950" />
                    <x-text-input id="ubi_latitud" type="number" name="ubi_latitud" step="0.00001" 
                        :value="old('ubi_latitud')" required class="mt-1 block w-full bg-gray-50" placeholder="Ej: 0.35836"
                        oninput="this.value = parseFloat(this.value).toFixed(5)" />
                    <x-input-error :messages="$errors->get('ubi_latitud')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="ubi_longitud" :value="__('Longitud *')" class="text-gray-950" />
                    <x-text-input id="ubi_longitud" type="number" name="ubi_longitud" step="0.00001" 
                        :value="old('ubi_longitud')" required class="mt-1 block w-full bg-gray-50" placeholder="Ej: -78.11147"
                        oninput="this.value = parseFloat(this.value).toFixed(5)" />
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
                    <option value="" disabled selected>Seleccione una región</option>
                    <option value="Sierra" {{ old('ubi_region') == 'Sierra' ? 'selected' : '' }}>Sierra</option>
                    <option value="Costa" {{ old('ubi_region') == 'Costa' ? 'selected' : '' }}>Costa</option>
                    <option value="Amazonía" {{ old('ubi_region') == 'Amazonía' ? 'selected' : '' }}>Amazonía</option>
                    <option value="Galápagos" {{ old('ubi_region') == 'Galápagos' ? 'selected' : '' }}>Región Insular (Galápagos)</option>
                </select>
                <x-input-error :messages="$errors->get('ubi_region')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="ubi_descripcion" :value="__('Descripción de la ubicación. (Opcional)')" class="text-gray-950" />
                <textarea id="ubi_descripcion" name="ubi_descripcion" 
                    class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50"
                    rows="3" placeholder="Ej: Zona montañosa cercana al río, altitud 2800 msnm...">{{ old('ubi_descripcion') }}</textarea>
                <x-input-error :messages="$errors->get('ubi_descripcion')" class="mt-2" />
            </div>
        </div>
    </div>
</div>
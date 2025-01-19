<div class="space-y-4">
    <div>
        <div>
            <x-input-label :value="__('Ubicación')" class="text-gray-600 font-bold mb-2"/>
            <x-map-location :lat="0.35836" :lng="-78.11147" />
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
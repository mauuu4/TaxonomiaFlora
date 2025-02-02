@props(['name', 'label' => 'Imágenes', 'maxImages' => 5])

<div
    x-data="imageUploader('{{ $name }}', {{ $maxImages }})"
    {{ $attributes }}
>
    <x-input-label :for="$name" :value="__($label)" class="text-gray-950" />
    <small class="text-gray-500">Máximo {{ $maxImages }} imágenes permitidas</small>
    
    <input 
        id="{{ $name }}"
        name="{{ $name }}[]" 
        type="file" 
        class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
        multiple 
        accept="image/*"
        :max="maxImages"
        {{-- required --}}
        @change="handleFiles"
    >
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
    <x-input-error :messages="$errors->get($name . '.*')" class="mt-2" />
        <x-input-label for="img_descripcion" :value="__('Descripción de las imagenes. (Opcional)')" class="text-gray-600" />
    
    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <template x-for="(preview, index) in previews" :key="preview.id">
            <div class="relative">
                <img :src="preview.url" alt="Vista previa" class="w-full h-32 object-cover rounded-md">                
                <input 
                    type="text" 
                    :name="`img_descripcion[${index}]`" 
                    x-model="preview.description"
                    placeholder="Descripción de la imagen" 
                    class="mt-2 block w-full text-sm border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
            </div>
        </template>
    </div>
</div>
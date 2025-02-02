<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Validar Especies') }}
        </h2>
    </x-slot>

    <div class="py-8 space-y-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 space-y-8">
                    <!-- Encabezado -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <h1 class="text-2xl font-bold text-gray-800">Validación de Especie</h1>
                                <span class="px-3 py-1 text-sm rounded-full 
                                    {{ $registro->regis_estado === 'Validado' ? 'bg-green-100 text-green-800' : 
                                       ($registro->regis_estado === 'Rechazado' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800') }}">
                                    {{ $registro->regis_estado }}
                                </span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600 space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>{{ $registro->user->user_nombre }}</span>
                                <span class="text-gray-400">•</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $registro->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        <a href="{{ route('validate.index') }}" 
                           class="px-4 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200 flex items-center gap-2 border border-gray-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            <span class="hidden sm:inline">Volver al listado</span>
                        </a>
                    </div>

                    <!-- Información Taxonómica -->
                    <section class="bg-green-50 rounded-xl p-6 border border-green-200">
                        <h2 class="text-xl font-semibold mb-4 text-green-800 flex items-center gap-2">
                            <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Información Taxonómica
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-green-900">Reino:</label>
                                <p class="font-medium text-gray-800">{{ $registro->especie->genero->familia->reino->reino_nombre }}</p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-green-900">Familia:</label>
                                <p class="font-medium text-gray-800">{{ $registro->especie->genero->familia->fam_nombre }}</p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-green-900">Género:</label>
                                <p class="font-medium text-gray-800">{{ $registro->especie->genero->gene_nombre }}</p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-green-900">Nombre Científico:</label>
                                <p class="font-medium text-gray-800 italic">{{ $registro->especie->esp_nombre_cientifico }}</p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-green-900">Nombre Común:</label>
                                <p class="font-medium text-gray-800">{{ $registro->especie->esp_nombre_comun }}</p>
                            </div>
                            <div class="md:col-span-2 space-y-2">
                                <label class="font-medium text-green-900">Descripción:</label>
                                <p class="font-medium text-gray-800 whitespace-pre-line">{{ $registro->especie->esp_descripcion }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- Galería de Imágenes -->
                    @if($registro->especie->imagenes->count() > 0)
                    <section class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700">Galería</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4" x-data="gallery()">
                            @foreach($registro->especie->imagenes as $index => $imagen)
                            <div class="group relative cursor-zoom-in" 
                                 @click="open({{ $index }})"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100">
                                <img src="{{ Storage::url($imagen->img_ruta) }}" 
                                     alt="Imagen de {{ $registro->especie->esp_nombre_cientifico }}"
                                     class="w-full h-48 object-cover rounded-lg shadow-sm group-hover:shadow-md transition-shadow">
                                @if($imagen->img_descripcion)
                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 p-4 rounded-b-lg">
                                    <p class="text-sm text-white font-medium">{{ $imagen->img_descripcion }}</p>
                                </div>
                                @endif
                            </div>
                            @endforeach
                            
                            <!-- Lightbox -->
                            <div x-show="isOpen" class="fixed inset-0 z-50 bg-black/75 flex items-center justify-center p-4"
                                 x-cloak
                                 @keydown.escape.window="close">
                                <div class="relative w-full max-w-4xl">
                                    <img :src="images[activeIndex]" 
                                         class="max-h-[80vh] w-full object-contain rounded-lg">
                                    <div class="absolute top-4 right-4">
                                        <button @click="close" 
                                                class="p-2 bg-white/90 rounded-full shadow-sm hover:bg-black">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    <!-- Ubicación -->
                    @if($registro->especie->ubicaciones->count() > 0)
                    <div class="bg-green-50 rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">Ubicación</h2>
                        @foreach($registro->especie->ubicaciones as $ubicacion)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm text-gray-600">Región:</p>
                                    <p class="font-medium">{{ $ubicacion->ubi_region }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Coordenadas:</p>
                                    <p class="font-medium">
                                        Lat: {{ $ubicacion->ubi_latitud }}, Long: {{ $ubicacion->ubi_longitud }}
                                    </p>
                                </div>
                                @if($ubicacion->ubi_descripcion)
                                <div class="col-span-2">
                                    <p class="text-sm text-gray-600">Descripción de la ubicación:</p>
                                    <p class="font-medium">{{ $ubicacion->ubi_descripcion }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="mt-4">
                                <x-map-location :lat="$ubicacion->ubi_latitud" :lng="$ubicacion->ubi_longitud" :interactive="false" />
                            </div>
                        @endforeach
                    </div>
                    @endif

                    @if ($registro->validaciones && $registro->validaciones->count() > 0)
                        <div class="mb-10">
                            <h2 class="text-2xl font-semibold mb-6 text-green-800 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Historial de Validaciones
                            </h2>
                            <div class="space-y-4">
                                @foreach ($registro->validaciones as $validacion)
                                    <div class="flex space-x-4 bg-green-50 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow duration-300">
                                        <!-- Avatar -->
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-green-200 text-green-900 flex items-center justify-center font-bold rounded-full">
                                                {{ strtoupper(substr(App\Models\User::find($validacion->valid_user_id)->user_nombre ?? 'U', 0, 1)) }}
                                            </div>
                                        </div>
                                        
                                        <!-- Content -->
                                        <div class="flex-1 space-y-2">
                                            <div class="flex items-center justify-between">
                                                <!-- User Name and Date -->
                                                <div>
                                                    <p class="text-green-900 font-semibold">
                                                        El usuario: {{ App\Models\User::find($validacion->valid_user_id)->user_nombre ?? 'Usuario desconocido' }}
                                                    </p>
                                                    <p class="text-gray-500 text-sm">
                                                        {{ $validacion->updated_at->format('d/m/Y H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <!-- Comment -->
                                            @if ($validacion->valid_comentarios)
                                                <p class="text-gray-700">
                                                    {{ $validacion->valid_comentarios }}
                                                </p>
                                            @else
                                                <p class="text-gray-400 italic">Sin comentarios.</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <!-- Formulario de Validación Mejorado -->
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Validación de Especie</h2>
                        <form x-data="{ action: 'validate' }" 
                            :action="action === 'validate' ? '{{ route('validate.validate', $registro->regis_id) }}' : '{{ route('validate.reject', $registro->regis_id) }}'" 
                            method="POST"
                            class="space-y-6">
                            @csrf
                            <input type="hidden" name="regis_id" value="{{ $registro->regis_id }}">

                            <!-- Campo de Comentarios -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Comentarios de Validación <span class="text-red-500">*</span>
                                </label>
                                <textarea name="valid_comentarios" 
                                        rows="4"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200"
                                        placeholder="Ingrese los comentarios de validación..."
                                        required></textarea>
                                @error('valid_comentarios')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Botones de Acción -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                
                                <!-- Rechazar -->
                                <button type="submit" 
                                        @click="action = 'reject'"
                                        class="w-full bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-lg 
                                            transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 
                                            focus:ring-red-500 focus:ring-offset-2">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Rechazar
                                    </span>
                                </button>

                                <!-- Validar -->
                                <button type="submit" 
                                        @click="action = 'validate'"
                                        class="w-full bg-green-600 hover:bg-green-700 text-white rounded-lg 
                                            transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 
                                            focus:ring-emerald-500 focus:ring-offset-2">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Validar
                                    </span>
                                </button>

                                <!-- Editar -->
                                <x-secondary-button href="{{ route('especies.edit', $registro->especie->esp_id) }}"
                                    class="bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Editar
                                </x-secondary-button>

                                <!-- Eliminar -->
                                <x-danger-button x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-especie-deletion')">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg> {{ __('ELIMINAR') }}
                                </x-danger-button>

                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="confirm-especie-deletion" :show="$errors->isNotEmpty()" focusable>
        <form method="post" action="{{ route('especies.destroy', $registro->especie->esp_id) }}"
            class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('¿Estás seguro de que deseas eliminar esta especie?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Una vez eliminada, toda la información asociada a esta especie será removida de forma permanente. Por favor, confirma tu acción antes de proceder.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Eliminar') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
    <script>
        function gallery() {
            return {
                images: @json($registro->especie->imagenes->map(fn($img) => Storage::url($img->img_ruta))),
                isOpen: false,
                activeIndex: 0,
                open(index) {
                    this.activeIndex = index
                    this.isOpen = true
                },
                close() {
                    this.isOpen = false
                }
            }
        }
    </script>
</x-app-layout>
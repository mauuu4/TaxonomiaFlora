<!-- resources/views/validate/show.blade.php -->
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Encabezado con botón de regreso -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">
                            Validación de Especie
                        </h1>
                        <a href="{{ route('validate.index') }}" 
                           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition duration-150 ease-in-out flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver
                        </a>
                    </div>

                    <!-- Información de la Especie -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">Información de la Especie</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-600">Género:</p>
                                <p class="font-medium">{{ $registro->especie->genero->gene_nombre }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Nombre Científico:</p>
                                <p class="font-medium">{{ $registro->especie->esp_nombre_cientifico }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Nombre Común:</p>
                                <p class="font-medium">{{ $registro->especie->esp_nombre_comun }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Descripción:</p>
                                <p class="font-medium">{{ $registro->especie->esp_descripcion }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Imágenes -->
                    @if($registro->especie->imagenes->count() > 0)
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">Imágenes</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($registro->especie->imagenes as $imagen)
                            <div class="relative">
                                <img src="{{ Storage::url($imagen->img_ruta) }}" 
                                     alt="Imagen de especie" 
                                     class="w-full h-48 object-cover rounded-lg">
                                @if($imagen->img_descripcion)
                                <p class="mt-2 text-sm text-gray-600">{{ $imagen->img_descripcion }}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Ubicación -->
                    @if($registro->especie->ubicaciones->count() > 0)
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
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
                        @endforeach
                    </div>
                    @endif

                    <!-- Formulario de Validación -->
                    <div class="bg-white rounded-lg shadow-sm p-6" x-data="{ action: 'validate' }">
                        <h2 class="text-xl font-semibold mb-4">Validación</h2>
                        
                        <div class="mb-4">
                            <div class="flex space-x-4 mb-4">
                                <button @click="action = 'validate'" 
                                        :class="action === 'validate' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'"
                                        class="px-4 py-2 rounded-md">
                                    Validar
                                </button>
                                <button @click="action = 'reject'" 
                                        :class="action === 'reject' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'"
                                        class="px-4 py-2 rounded-md">
                                    Rechazar
                                </button>
                            </div>

                            <form x-show="action === 'validate'"
                                  action="{{ route('validate.validate', $registro->regis_id) }}" 
                                  method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Comentarios de Validación
                                    </label>
                                    <textarea name="valid_comentarios" 
                                              rows="4" 
                                              class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                              required></textarea>
                                </div>
                                <button type="submit" 
                                        class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-150 ease-in-out">
                                    Validar Especie
                                </button>
                            </form>

                            <form x-show="action === 'reject'"
                                  action="{{ route('validate.reject', $registro->regis_id) }}" 
                                  method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Motivo del Rechazo
                                    </label>
                                    <textarea name="valid_comentarios" 
                                              rows="4" 
                                              class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                              required></textarea>
                                </div>
                                <button type="submit" 
                                        class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition duration-150 ease-in-out">
                                    Rechazar Especie
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
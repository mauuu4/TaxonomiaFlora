<x-app-layout :nav="'dashboard'">
    <div class="py-8 bg-green-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="p-8">
                    <!-- Sección de encabezado con tipografía mejorada y espaciado -->
                    <div class="mb-8 border-b border-green-300 pb-6">
                        <h1 class="text-4xl font-bold text-green-800 mb-2 italic">{{ $especie->esp_nombre_cientifico }}</h1>
                        <p class="text-lg">Nombre común: {{ $especie->esp_nombre_comun }}</p>
                    </div>

                    <!-- Información general con diseño tipo tarjeta -->
                    <div class="mb-10 bg-green-50 rounded-xl p-6 shadow-md">
                        <h2 class="text-2xl font-semibold mb-4 text-green-800 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Información General
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <p class="text-gray-700"><span class="font-semibold text-green-900">Género:</span> {{ $especie->genero->gene_nombre }}</p>
                                <div>
                                    <p class="font-semibold text-green-900 mb-2">Descripción:</p>
                                    <p class="text-gray-700 leading-relaxed">{{ $especie->esp_descripcion ?? 'No hay descripción disponible.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de imágenes con cuadrícula mejorada y efectos hover -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-semibold mb-6 text-green-800 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Imágenes
                        </h2>
                        @if($especie->imagenes && $especie->imagenes->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($especie->imagenes as $imagen)
                                    <div class="group relative transition-all duration-300 transform hover:-translate-y-1">
                                        <div class="overflow-hidden rounded-xl shadow-lg">
                                            <img src="{{ asset('storage/' . $imagen->img_ruta) }}" 
                                                 alt="Imagen de {{ $especie->esp_nombre_comun }}"
                                                 class="w-full h-56 object-cover transform transition-transform duration-300 group-hover:scale-105">
                                        </div>
                                        @if($imagen->img_descripcion)
                                            <div class="mt-3 text-sm text-gray-600 font-medium">
                                                {{ $imagen->img_descripcion }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600 bg-green-50 rounded-lg p-4 text-center">No hay imágenes disponibles.</p>
                        @endif
                    </div>

                    <!-- Sección de ubicación con diseño mejorado -->
                    @if($especie->ubicaciones && $especie->ubicaciones->count() > 0)
                        <div class="mb-10">
                            <h2 class="text-2xl font-semibold mb-6 text-green-800 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Ubicación
                            </h2>
                            <div class="space-y-4">
                                @if($ubicacion = $especie->ubicaciones->first())
                                    <div>
                                        <p class="text-gray-700">
                                            <span class="font-semibold text-green-900">Región:</span> {{ $ubicacion->ubi_region }}
                                        </p>
                                        <p class="text-gray-700">
                                            <span class="font-semibold text-green-900">Descripción:</span><br>
                                            <span class="text-gray-600 mt-2 block">{{ $ubicacion->ubi_descripcion }}</span>
                                        </p>
                                    </div>
                                    <div class="mt-4">
                                        <x-map-location :lat="$ubicacion->ubi_latitud" :lng="$ubicacion->ubi_longitud" :interactive="false" />
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- historial de validaciones tipo comentarios --}}
                    @if($validaciones && $validaciones->count() > 0)
                        <div class="mb-10">
                            <h2 class="text-2xl font-semibold mb-6 text-green-800 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Historial de Validaciones
                            </h2>
                            <div class="space-y-4">
                                @foreach($validaciones as $validacion)
                                    <div class="bg-green-50 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="space-y-3">
                                                <p class="text-gray-700">
                                                    <span class="font-semibold text-green-900">El usuario:</span>
                                                    {{$user = App\Models\User::find($validacion->valid_user_id)->user_nombre}} sugirio:
                                                </p>
                                                <div>
                                                    <span class="font-semibold text-green-900 mb-2">Fecha:</span>
                                                    {{ $validacion->valid_fecha }}
                                                </div>
                                            </div>
                                            <div>
                                                @if($validacion->valid_comentarios)
                                                    <p class="text-gray-700">
                                                        <span class="font-semibold text-green-900">Comentario:</span><br>
                                                        <span class="text-gray-600 mt-2 block">{{ $validacion->valid_comentarios }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Botones de acción con estilo mejorado -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-green-200">
                        <a href="{{ route('especies.index') }}" 
                           class="px-6 py-2.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors duration-200 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
                            </svg>
                            Volver
                        </a>
                        <a href="{{ route('especies.edit', $especie->esp_id) }}" 
                           class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Editar
                        </a>
                        <form action="{{ route('especies.destroy', $especie->esp_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-6 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 inline-flex items-center"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta especie?')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

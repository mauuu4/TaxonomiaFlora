<x-app-layout :nav="'dashboard'">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Encabezado -->
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $especie->esp_nombre_cientifico }}</h1>
                        <p class="text-gray-600">Nombre común: {{ $especie->esp_nombre_comun }}</p>
                    </div>

                    <!-- Información básica -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-3 text-gray-700">Información General</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-600"><span class="font-semibold">Género:</span> {{ $especie->genero->gene_nombre }}</p>
                                <p class="text-gray-600"><span class="font-semibold">Descripción:</span></p>
                                <p class="text-gray-700 mt-1">{{ $especie->esp_descripcion ?? 'No hay descripción disponible.' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Imágenes -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-3 text-gray-700">Imágenes</h2>
                        @if($especie->imagenes && $especie->imagenes->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($especie->imagenes as $imagen)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $imagen->img_ruta) }}" 
                                             alt="Imagen de {{ $especie->esp_nombre_comun }}"
                                             class="w-full h-48 object-cover rounded-lg shadow-md">
                                        @if($imagen->img_descripcion)
                                            <div class="mt-2 text-sm text-gray-600">
                                                {{ $imagen->img_descripcion }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600">No hay imágenes disponibles.</p>
                        @endif
                    </div>

                    <!-- Ubicación -->
                    @if($especie->ubicaciones && $especie->ubicaciones->count() > 0)
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-3 text-gray-700">Ubicación</h2>
                            @foreach($especie->ubicaciones as $ubicacion)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-gray-600">
                                                <span class="font-semibold">Región:</span> 
                                                {{ $ubicacion->ubi_region }}
                                            </p>
                                            <p class="text-gray-600">
                                                <span class="font-semibold">Coordenadas:</span><br>
                                                Latitud: {{ $ubicacion->ubi_latitud }}<br>
                                                Longitud: {{ $ubicacion->ubi_longitud }}
                                            </p>
                                        </div>
                                        <div>
                                            @if($ubicacion->ubi_descripcion)
                                                <p class="text-gray-600">
                                                    <span class="font-semibold">Descripción de la ubicación:</span><br>
                                                    {{ $ubicacion->ubi_descripcion }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Botones de acción -->
                    <div class="flex justify-end space-x-4 mt-6">
                        <a href="{{ route('especies.index') }}" 
                           class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Volver
                        </a>
                        <a href="{{ route('especies.edit', $especie->esp_id) }}" 
                           class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Editar
                        </a>
                        <form action="{{ route('especies.destroy', $especie->esp_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta especie?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
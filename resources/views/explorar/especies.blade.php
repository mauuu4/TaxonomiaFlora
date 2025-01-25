<x-home-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" 
        x-data="{ 
            viewMode: localStorage.getItem('speciesViewMode') || 'grid',
            updateViewMode(mode) {
                this.viewMode = mode;
                localStorage.setItem('speciesViewMode', mode);
            }
        }">
            <!-- Cabecera con título, búsqueda y toggle de vista -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                            Explorador de Especies
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            Descubre la diversidad de especies en nuestra base de datos
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <div class="flex space-x-3">
                            <!-- Toggle de vista -->
                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                <button @click="updateViewMode('grid')" type="button" :class="{'bg-indigo-600 text-white': viewMode === 'grid', 'bg-white text-gray-700': viewMode !== 'grid'}" class="inline-flex items-center px-4 py-2 text-sm font-medium border border-gray-300 rounded-l-lg focus:z-10 focus:ring-2 focus:ring-indigo-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                    </svg>
                                    Tarjetas
                                </button>
                                <button @click="updateViewMode('table')" type="button" :class="{'bg-indigo-600 text-white': viewMode === 'table', 'bg-white text-gray-700': viewMode !== 'table'}" class="inline-flex items-center px-4 py-2 text-sm font-medium border border-gray-300  focus:z-10 focus:ring-2 focus:ring-indigo-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    Tabla
                                </button>
                                <button @click="updateViewMode('map')" type="button" :class="{'bg-indigo-600 text-white': viewMode === 'map', 'bg-white text-gray-700': viewMode !== 'map'}" class="inline-flex items-center px-4 py-2 text-sm font-medium border border-gray-300 rounded-r-lg focus:z-10 focus:ring-2 focus:ring-indigo-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                                    Mapa
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @include('especies.partials.filters', ['generos' => $generos, 'familias' => $familias, 'action' => route('explorar.especies')])

            <div class="mt-8 border-t bg-white rounded-xl shadow-lg p-6">
                {{-- Vista de Tarjetas --}}
                <div x-show="viewMode === 'grid'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($registros as $registro)
                        <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition-shadow duration-300">
                            <div class="relative pb-48">
                                <img class="absolute h-full w-full object-cover" src="{{ asset('storage/'.$registro->img_ruta) }}" alt="{{$registro->esp_nombre_cientifico}}">
                            </div>
                            <div class="p-4">
                                <div class="uppercase tracking-wide text-sm font-semibold">
                                    {{ $registro->reino_nombre }}
                                </div>
                                <h3 class="mt-1 text-lg font-medium leading-6">
                                    <span class="italic text-emerald-500">{{ $registro->esp_nombre_cientifico }}</span>
                                </h3>
                                <p class="mt-1 text-gray-500">{{ $registro->esp_nombre_comun }}</p>
                                <div class="mt-4">
                                    <span class="inline-flex items-center  py-0.5 rounded-full text-xs font-medium text-green-800">
                                        Registrado por: {{ $registro->user_nombre_completo }}
                                    </span>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-4 sm:px-6">
                                <div class="text-sm">
                                    <a href="{{ route('especies.show', $registro->esp_id) }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Ver detalles<span class="ml-1">&rarr;</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Vista de Tabla -->
                <div x-show="viewMode === 'table'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <div class="shadow overflow-x-auto overflow-y-auto border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                @include('especies.partials.table-header', ['viewType' => 'public'])
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($registros as $registro)
                                    @include('especies.partials.table-row', ['viewType' => 'public'])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Map View -->
                <div x-show="viewMode === 'map'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <div id="species-map" class="w-full h-[600px] bg-gray-200 rounded-lg shadow-md"></div>
                </div>
            </div>

            <!-- Paginación -->
            <div class="mt-8">
                {{ $registros->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
    <script>
        // Leaflet Map Initialization
        document.addEventListener('alpine:init', () => {
            const speciesData = [
                @foreach ($registros as $registro)
                {
                    lat: {{ $registro->ubi_latitud }},
                    lng: {{ $registro->ubi_longitud }},
                    name: "{{ $registro->esp_nombre_cientifico }}",
                    commonName: "{{ $registro->esp_nombre_comun }}",
                    image: "{{ asset('storage/'.$registro->img_ruta) }}",
                    id: {{ $registro->esp_id }}
                },
                @endforeach
            ];

            const map = L.map('species-map').setView([0.35836, -78.11147], 16); // Default to Argentina

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            speciesData.forEach(species => {
                if (species.lat !== 0 && species.lng !== 0) {
                    const marker = L.marker([species.lat, species.lng]).addTo(map);
                    marker.bindPopup(`
                        <div class="p-2">
                            <img src="${species.image}" class="w-32 h-32 object-cover mb-2 rounded">
                            <h3 class="font-bold italic text-emerald-600">${species.name}</h3>
                            <p class="text-gray-600">${species.commonName}</p>
                            <a href="/especies/${species.id}" class="text-indigo-600 hover:underline">Ver detalles</a>
                        </div>
                    `);
                }
            });
        });
    </script>
</x-home-layout>
<x-app-layout>
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

                    <x-view-mode-toggle/>

                </div>
            </div>
            
            @include('especies.partials.filters', ['generos' => $generos, 'familias' => $familias, 'action' => route('explorar.especies')])

            @if ($registros->isEmpty())
                <div class="mt-8 bg-white rounded-xl shadow-lg p-6 text-center">
                    <p class="text-lg text-gray-500">No se encontraron resultados</p>
                </div>

            @else
                <div class="mt-8 border-t bg-white rounded-xl shadow-lg p-6">
                    <!-- Vista de Tarjeta -->
                    @include('especies.partials.grid-view')

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
                    
                    <x-map-view :registros="$registros"/>
                    
                </div>
            @endif

            <!-- Paginación -->
            <div class="mt-8">
                {{ $registros->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
   
</x-app-layout>
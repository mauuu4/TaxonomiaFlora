<x-app-layout   >
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"
        x-data="{ 
            viewMode: localStorage.getItem('speciesViewMode') || 'table',
            updateViewMode(mode) {
                this.viewMode = mode;
                localStorage.setItem('speciesViewMode', mode);
            }
        }">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Encabezado -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">
                            {{ __('Especies Pendientes de Validación') }}
                        </h1>
                    </div>

                    @include('especies.partials.filters', ['generos' => $generos, 'familias' => $familias, 'action' => route('validate.index')])

                    <!-- Tabla de Especies por Validar -->
                    <div x-show="viewMode === 'table'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <div class="shadow overflow-x-auto overflow-y-auto border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    @include('especies.partials.table-header', ['viewType' => 'taxonomo'])
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($registros as $registro)
                                        @include('especies.partials.table-row', ['viewType' => 'taxonomo'])
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-6">
                        {{ $registros->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
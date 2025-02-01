<x-app-layout>
    <div class="py-12 bg-green-50">
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
                    <!-- Encabezado y Botón de Registro -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">
                            {{ __('Especies Registradas') }}
                        </h1>
                        <x-secondary-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-especie-modal')" class="bg-green-600 hover:bg-green-700 text-white">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Registrar Especie
                        </x-secondary-button>
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center md:justify-end">
                        <x-view-mode-toggle/>
                    </div>

                    @if(auth()->user()->registros->isEmpty())
                        <div class="flex flex-col items-center justify-center">
                            <p class="text-gray-500 text-lg">No has registrado ninguna especie.</p>
                        </div>
                    @else
                        <!-- Formulario de búsqueda -->
                        @include('especies.partials.filters', ['generos' => $generos, 'familias' => $familias, 'action' => route('especies.index')])

                        @include('especies.partials.grid-view')
                        <!-- Tabla de Especies -->
                        <div x-show="viewMode === 'table'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                            <div class="shadow overflow-x-auto overflow-y-auto border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        @include('especies.partials.table-header', ['viewType' => 'usuario'])
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($registros as $registro)
                                            @include('especies.partials.table-row', ['viewType' => 'usuario'])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <x-map-view :registros="$registros"/>
                    @endif
                    <!-- Paginación -->
                    <div class="mt-6">
                        {{ $registros->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="create-especie-modal" :show="$errors->isNotEmpty()" focusable maxWidth="4xl">
        <div class="p-10">
            <h2 class="text-lg font-medium text-gray-900 mb-6 text-center">
                {{ __('Registrar Especie') }}
            </h2>
            <div class="mb-4 text-sm text-gray-600">
                <p><strong>*</strong> Los campos marcados con asterisco son obligatorios.</p>
            </div>
            <form method="POST" action="{{ route('especies.store') }}" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="grid md:grid-cols-2 gap-6">
                    @include('especies.partials.form-left-column')
                    @include('especies.partials.form-right-column')
                </div>
                <div class="flex items-center justify-end mt-6 space-x-4">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancelar') }}
                    </x-secondary-button>
                    <x-primary-button class="bg-green-500 hover:bg-green-700 focus:bg-green-700 active:bg-green-700">
                        {{ __('Guardar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
</x-app-layout>
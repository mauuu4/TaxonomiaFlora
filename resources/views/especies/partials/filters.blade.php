<div class="mb-8">
    <form method="GET" action="{{ $action }}" class="bg-white rounded-xl shadow-lg p-6">
        <!-- Título del filtro -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                {{ __('Filtros de búsqueda') }}
            </h3>
        </div>

        <!-- Grid de filtros -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Filtro por Familia -->
            <div class="space-y-2">
                <label for="familia" class="block text-sm font-medium text-gray-700">
                    {{ __('Familia') }}
                </label>
                <div class="relative">
                    <select name="familia" id="familia" class="block w-full pl-3 pr-10 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent appearance-none">
                        <option value="">{{ __('Todas las familias') }}</option>
                        @foreach ($familias as $fam)
                            <option value="{{ $fam->fam_id }}" {{ request('familia') == $fam->fam_id ? 'selected' : '' }}>
                                {{ $fam->fam_nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filtro por Género -->
            <div class="space-y-2">
                <label for="genero" class="block text-sm font-medium text-gray-700">
                    {{ __('Género') }}
                </label>
                <div class="relative">
                    <select name="genero" id="genero" class="block w-full pl-3 pr-10 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent appearance-none">
                        <option value="">{{ __('Todos los géneros') }}</option>
                        @foreach ($generos as $gen)
                            <option value="{{ $gen->gene_id }}" {{ request('genero') == $gen->gene_id ? 'selected' : '' }}>
                                {{ $gen->gene_nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filtro por Estado -->
            <div class="space-y-2">
                <label for="estado" class="block text-sm font-medium text-gray-700">
                    {{ __('Estado') }}
                </label>
                <div class="relative">
                    <select name="estado" id="estado" class="block w-full pl-3 pr-10 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent appearance-none">
                        <option value="">{{ __('Todos los estados') }}</option>
                        <option value="Pendiente" {{ request('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Validado" {{ request('estado') == 'Validado' ? 'selected' : '' }}>Validado</option>
                        <option value="Rechazado" {{ request('estado') == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Barra de búsqueda y botón -->
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="relative flex-grow">
                <input type="text" 
                       name="search" 
                       id="search"
                       value="{{ request()->search }}" 
                       class="block w-full pl-10 pr-3 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                       placeholder="Buscar por nombre común o científico">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-green-500 hover:bg-green-600 text-white font-medium text-sm rounded-lg transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 whitespace-nowrap">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                {{ __('Aplicar Filtros') }}
            </button>
            <!-- Botón para Limpiar Filtros -->
            <a href="{{ $action }}" class="inline-flex items-center px-6 py-2.5 bg-blue-500 hover:bg-blue-600 text-white font-medium text-sm rounded-lg transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 whitespace-nowrap">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                {{ __('Limpiar Filtros') }}
            </a>
        </div>
    </form>
</div>
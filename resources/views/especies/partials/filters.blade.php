<div class="mb-8">
    <form method="GET" action="{{ route('especies.index') }}" class="bg-white rounded-xl shadow-lg p-6">
        <!-- Título del filtro -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                {{ __('Filtros de búsqueda') }}
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Filtro por Reino -->
            <div class="space-y-2">
                <label for="reino" class="block text-sm font-medium text-gray-700">
                    {{ __('Reino') }}
                </label>
                <div class="relative">
                    <select name="reino" id="reino" class="block w-full pl-3 pr-10 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent appearance-none">
                        <option value="">{{ __('Todos los reinos') }}</option>
                        @foreach ($reinos as $reinoItem)
                            <option value="{{ $reinoItem->reino_id }}" {{ request('reino') == $reinoItem->reino_id ? 'selected' : '' }}>
                                {{ $reinoItem->reino_nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

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

            <!-- Búsqueda -->
            <div class="space-y-2">
                <label for="search" class="block text-sm font-medium text-gray-700">
                    {{ __('Búsqueda') }}
                </label>
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           id="search"
                           value="{{ request()->search }}" 
                           class="block w-full pl-10 pr-3 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Nombre común o científico">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón de filtrado -->
        <div class="mt-6 flex justify-end">
            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-green-500 hover:bg-green-600 text-white font-medium text-sm rounded-lg transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                {{ __('Aplicar Filtros') }}
            </button>
        </div>
    </form>
</div>
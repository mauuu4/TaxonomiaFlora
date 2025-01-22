<x-home-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ viewMode: 'grid' }">
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
                                <button @click="viewMode = 'grid'" type="button" :class="{'bg-indigo-600 text-white': viewMode === 'grid', 'bg-white text-gray-700': viewMode !== 'grid'}" class="inline-flex items-center px-4 py-2 text-sm font-medium border border-gray-300 rounded-l-lg focus:z-10 focus:ring-2 focus:ring-indigo-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                    </svg>
                                    Tarjetas
                                </button>
                                <button @click="viewMode = 'table'" type="button" :class="{'bg-indigo-600 text-white': viewMode === 'table', 'bg-white text-gray-700': viewMode !== 'table'}" class="inline-flex items-center px-4 py-2 text-sm font-medium border border-gray-300 rounded-r-lg focus:z-10 focus:ring-2 focus:ring-indigo-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    Tabla
                                </button>
                            </div>

                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                    </svg>
                                    Filtros
                                </button>
                                <!-- Panel de filtros -->
                                <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-screen max-w-md rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50">
                                    <div class="px-4 py-5 sm:p-6">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Filtrar especies</h3>
                                        <div class="mt-4 space-y-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Reino</label>
                                                <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                    <option>Todos</option>
                                                    <!-- @foreach($reinos as $reino) -->
                                                    <option value="{{ $reino->id }}">{{ $reino->reino_nombre }}</option>
                                                    <!-- @endforeach -->
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Estado</label>
                                                <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                    <option>Todos</option>
                                                    <option>Aceptada</option>
                                                    <option>En revisión</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <!-- Barra de búsqueda -->
                             <div class="flex-1 min-w-0">
                                <div class="relative rounded-md shadow-sm">
                                    <input type="text" name="search" class="block w-full pr-10 sm:text-sm border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="Buscar especies...">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vista de Grid (tarjetas) -->
            <div x-show="viewMode === 'grid'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($especies as $especie)
                    <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="relative pb-48">
                            <img class="absolute h-full w-full object-cover" src="{{ asset('storage/'.$especie->imagenes->first()->img_ruta) }}" alt="{{$especie->esp_nombre_cientifico}}">
                        </div>
                        <div class="p-4">
                            <div class="uppercase tracking-wide text-sm font-semibold">
                                {{ $especie->genero->familia->reino->reino_nombre }}
                            </div>
                            <h3 class="mt-1 text-lg font-medium leading-6">
                                <span class="italic text-emerald-500">{{ $especie->esp_nombre_cientifico }}</span>
                            </h3>
                            <p class="mt-1 text-gray-500">{{ $especie->esp_nombre_comun }}</p>
                            <div class="mt-4">
                                <span class="inline-flex items-center  py-0.5 rounded-full text-xs font-medium text-green-800">
                                    Registrado por: {{ $especie->registros->first()->user->user_nombre }}
                                </span>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-4 sm:px-6">
                            <div class="text-sm">
                                <a href="{{ route('especies.public.show', $especie->esp_id) }}" class="font-medium text-indigo-600 hover:text-indigo-500">
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
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Imagen
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre Científico
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre Común
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Genero
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Familia
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Reino
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Registrado por
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($especies as $especie)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex-shrink-0 h-24 w-24 group relative">
                                            <img class="h-24 w-24 rounded-lg object-cover shadow-sm hover:shadow-md transition-shadow duration-200" 
                                                src="{{ asset('storage/'.$especie->imagenes->first()->img_ruta) }}" 
                                                alt="{{$especie->esp_nombre_cientifico}}">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900 italic">
                                            {{ $especie->esp_nombre_cientifico }}
                                        </div>                                    
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">
                                            {{ $especie->esp_nombre_comun }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">
                                            {{ $especie->genero->gene_nombre }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            {{ $especie->genero->familia->fam_nombre }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Género: {{ $especie->genero->gene_nombre }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            {{ $especie->genero->familia->reino->reino_nombre }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $especie->registros->first()->user->user_nombre }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    Registrado: {{ $especie->registros->first()->created_at->format('d/m/Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('especies.public.show', $especie->esp_id) }}" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center">
                                            Ver detalles
                                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Paginación -->
            <div class="mt-8">
                {{ $especies->links() }}
            </div>
        </div>
    </div>
</x-home-layout>
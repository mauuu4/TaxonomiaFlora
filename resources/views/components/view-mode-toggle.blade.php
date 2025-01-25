<div class="mt-4 md:mt-0">
    <div class="flex space-x-3">
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
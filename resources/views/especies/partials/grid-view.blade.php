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
<tr class="hover:bg-gray-50">
    @if($viewType === 'usuario' || $viewType === 'public')
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">
                {{ $registro->reino_nombre }}
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">
                {{ $registro->fam_nombre }}
            </div>
        </td>
    @endif
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">
            {{ $registro->gene_nombre }}
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900 italic">
            {{ $registro->esp_nombre_cientifico }}
        </div>
    </td>
    <td class="px-6 py-4">
        <div class="text-sm text-gray-500">
            <span class="whitespace-normal">
                {{ $registro->esp_nombre_comun }}
            </span>
        </div>
    </td>
    @if($viewType === 'public' || $viewType === 'taxonomo')
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-900">
                        {{ $registro->user_nombre_completo }}
                    </div>
                    <div class="text-xs text-gray-500">
                        Registrado el: {{ \Carbon\Carbon::parse($registro->created_at)->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        </td>
    @endif
    @if($viewType === 'usuario' || $viewType === 'taxonomo')
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                {{ $registro->regis_estado === 'Validado' ? 'bg-green-100 text-green-800' : 
                ($registro->regis_estado === 'Rechazado' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                {{ $registro->regis_estado }}
            </span>
        </td>
        <td class="px-6 py-4">
            <div class="text-sm text-gray-500">
                @if($registro->total_validaciones > 0)
                    <span class="whitespace-normal">
                        {{ $registro->ultimo_comentario }}
                    </span>
                    @if($registro->total_validaciones > 1)
                        <span class="text-xs text-gray-400 block mt-1">
                            ({{ $registro->total_validaciones }} validaciones en total)
                        </span>
                    @endif
                @else
                    <span class="text-gray-400 italic">Sin validaciones</span>
                @endif
            </div>
        </td>
    @endif
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex-shrink-0 h-24 w-24 group relative">
            <img class="h-24 w-24 rounded-lg object-cover shadow-sm hover:shadow-md transition-shadow duration-200" 
                src="{{ asset('storage/'.$registro->img_ruta) }}" 
                alt="{{$registro->esp_nombre_cientifico}}">
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <a href="{{ $viewType === 'taxonomo' ? route('validate.show', $registro->regis_id) : route('especies.show', $registro->esp_id) }}" 
           class="text-indigo-600 hover:text-indigo-900 inline-flex items-center">
            Ver detalles
            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
        </a>
    </td>
</tr>
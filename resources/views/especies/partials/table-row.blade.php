<tr class="hover:bg-gray-50">
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
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-500">
            {{ $registro->esp_nombre_comun }}
        </div>
    </td>
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
                @if($registro->validaciones->count() > 1)
                    <span class="text-xs text-gray-400 block mt-1">
                        ({{ $registro->total_validaciones }} validaciones en total)
                    </span>
                @endif
            @else
                <span class="text-gray-400 italic">Sin validaciones</span>
            @endif
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <div class="flex justify-end space-x-3">
            <a href="{{ route('especies.show', $registro->esp_id) }}" 
               class="text-indigo-600 hover:text-indigo-900">
                Ver
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </a>
        </div>
    </td>
</tr>
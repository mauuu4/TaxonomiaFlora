<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Familias Botánicas') }}
            </h2>
            <x-secondary-button x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'create-familia-modal')" class="bg-green-600 hover:bg-green-700 text-white">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Registrar Nueva Familia
            </x-secondary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($familias as $familia)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $familia->fam_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $familia->fam_nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex justify-end space-x-2">
                                            <button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'edit-familia-modal')" class="text-blue-600 hover:text-blue-900">
                                                Editar
                                            </button>
                                            <button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-familia-deletion')" class="text-red-600 hover:text-red-900">
                                                Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                        No hay familias registradas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $familias->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="create-familia-modal" :show="$errors->isNotEmpty()">
        <div class="p-10">
            <h2 class="text-lg font-medium text-gray-900 mb-6 text-center">
                {{ __('Registrar nueva Familia Botánica') }}
            </h2>
            <form method="POST" action="{{ route('familias.store') }}" class="mt-4">
                @csrf
                    <div>
                        <x-input-label for="fam_nombre" :value="__('Nombre de la Familia')" />
                        <x-text-input id="fam_nombre" 
                                      name="fam_nombre" 
                                      type="text" 
                                      class="mt-1 block w-full" 
                                      :value="old('fam_nombre')"
                                      required 
                                      autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('fam_nombre')" />
                    </div>
                <div class="flex items-center justify-center mt-6 space-x-4">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button class="bg-green-500 hover:bg-green-700 focus:bg-green-700 active:bg-green-700">
                        {{ __('Guardar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
    <x-modal name="edit-familia-modal" :show="$errors->isNotEmpty()">
        <div class="p-10">
            <h2 class="text-lg font-medium text-gray-900 mb-6 text-center">
                {{ __('Editar Familia Botánica') }}
            </h2>
            <form method="POST" action="{{ route('familias.update', $familia) }}" class="mt-4">
                @csrf
                @method('PATCH')
                    <div>
                        <x-input-label for="fam_nombre" :value="__('Nombre de la Familia')" />
                        <x-text-input id="fam_nombre" 
                                      name="fam_nombre" 
                                      type="text" 
                                      class="mt-1 block w-full" 
                                      :value="old('fam_nombre', $familia->fam_nombre)"
                                      required 
                                      autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('fam_nombre')" />
                    </div>
                <div class="flex items-center justify-center mt-6 space-x-4">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button class="bg-green-500 hover:bg-green-700 focus:bg-green-700 active:bg-green-700">
                        {{ __('Actualizar Familia') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
    <x-modal name="confirm-familia-deletion" :show="$errors->isNotEmpty()" focusable>
        <form method="post" action="{{ route('familias.destroy', $familia) }}"
            class="p-6">
            @csrf
            @method('delete')
            <div class="p-10">
                <h2 class="text-lg font-medium text-gray-900 mb-6 text-center">
                    {{ __('Eliminar Familia Botánica') }}
                </h2>
                <p class="text-center text-gray-500">¿Estás seguro de que deseas eliminar esta familia botánica?</p>
                <div class="flex items-center justify-center mt-6 space-x-4">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancelar
                    </x-secondary-button>
                    <x-danger-button class="ms-3">
                        {{ __('Eliminar') }}
                    </x-danger-button>
                </div>
            </div>
        </form>
    </x-modal>
</x-app-layout>
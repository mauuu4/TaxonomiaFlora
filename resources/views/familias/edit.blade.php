<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Familia Botánica') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('familias.update', $familia) }}">
                        @csrf
                        @method('PATCH')

                        <div>
                            <x-input-label for="fam_nombre" :value="__('Nombre de la Familia')" />
                            <x-text-input id="fam_nombre" 
                                          name="fam_nombre" 
                                          type="text" 
                                          class="mt-1 block w-full" 
                                          :value="old('fam_nombre', $familia->fam_nombre)" 
                                          required />
                            <x-input-error class="mt-2" :messages="$errors->get('fam_nombre')" />
                        </div>

                        <div class="flex items-center justify-center mt-6 space-x-4">
                            <x-secondary-button href="{{ route('familias.index') }}">
                                Cancelar
                            </x-secondary-button>
                            <x-primary-button class="bg-green-500 hover:bg-green-700 focus:bg-green-700 active:bg-green-700">
                                {{ __('Actualizar Familia') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

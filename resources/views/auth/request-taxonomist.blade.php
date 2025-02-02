<x-app-layout>
    <div class="min-h-screen flex items-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 mx-auto">
            <div class="text-center">
                <svg class="mx-auto h-16 w-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h2 class="mt-2 text-3xl font-extrabold text-gray-900">
                    Solicitud de Taxónomo
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    ¿Quieres contribuir como experto en taxonomía?
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-xl overflow-hidden transition-all duration-300 ease-in-out transform hover:shadow-2xl">
                <div class="px-8 py-6 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100">
                    <h3 class="text-lg font-semibold text-green-800">Requisitos del puesto</h3>
                </div>
                
                <form method="POST" action="{{ route('request-taxonomist.store') }}" class="px-8 py-6">
                    @csrf
                    
                    <div class="rounded-md bg-blue-50 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm text-blue-700">
                                    Los administradores revisarán tu perfil y experiencia antes de aprobar tu solicitud.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="group relative w-full flex justify-center items-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-green-300 group-hover:text-green-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </span>
                            Enviar solicitud ahora
                        </button>
                    </div>
                </form>
                
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <p class="text-xs text-gray-500 text-center">
                        Recibirás una respuesta por correo electrónico en un plazo máximo de 72 horas.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
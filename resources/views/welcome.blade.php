<x-home-layout>
    <main class="min-h-screen bg-gradient-to-b from-emerald-50 via-green-50 to-emerald-100">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center py-16 relative z-10">
                    <h1 class="text-4xl lg:text-6xl font-bold text-emerald-900 mb-6">
                        Explora el Mundo de la 
                        <span class="text-emerald-600">Flora</span>
                    </h1>
                    <p class="text-xl max-w-2xl mx-auto mb-6 leading-relaxed">
                        Descubre, explora y contribuye al conocimiento botánico mundial. Una plataforma dedicada a la clasificación y documentación de especies vegetales.
                    </p>

                    <!-- Texto Inspirador -->
                    <p class="text-lg max-w-xl mx-auto mb-8 text-emerald-800 font-medium">
                        Comienza tu viaje botánico: explora nuevas especies, aprende sobre su diversidad y conecta con la naturaleza de una forma única.
                    </p>

                    <!-- Buscador de Especie Mejorado -->
                    <div class="max-w-2xl mx-auto mb-12">
                        <form action="{{ route('explorar.especies') }}" method="GET" class="relative">
                            <input type="text" 
                                   id="search" 
                                   name="search" 
                                   placeholder="Buscar especies por nombre común o científico..." 
                                   class="w-full py-4 px-6 pl-14 text-lg rounded-full border-2 border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 shadow-lg transition-all duration-300"
                            />
                            <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <div class="flex justify-center gap-6">
                        <a href="{{ route('register') }}" 
                           class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-4 px-8 rounded-full shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                            {{ __('Registrarse') }}
                        </a>
                        <a href="{{ route('login') }}" 
                           class="bg-white hover:bg-gray-50 text-emerald-600 font-semibold py-4 px-8 rounded-full shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl border border-emerald-200">
                            {{ __('Iniciar Sesión') }}
                        </a>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 py-12">
                    <!-- Feature 1 -->
                    <div class="bg-white rounded-xl shadow-xl p-8 transition duration-300 hover:shadow-2xl">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-emerald-800 mb-4">Explora Especies</h3>
                        <p class="text-gray-600">Accede a nuestro extenso catálogo de especies vegetales, organizadas por familias, géneros y especies. Descubre la rica biodiversidad de nuestro planeta.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white rounded-xl shadow-xl p-8 transition duration-300 hover:shadow-2xl">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-emerald-800 mb-4">Registra Nuevas Especies</h3>
                        <p class="text-gray-600">Contribuye al conocimiento científico registrando nuevos hallazgos. Documenta características, ubicación y comparte fotografías detalladas.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white rounded-xl shadow-xl p-8 transition duration-300 hover:shadow-2xl">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-emerald-800 mb-4">Validación Científica</h3>
                        <p class="text-gray-600">Expertos taxónomos revisan y validan cada registro para garantizar la precisión y calidad de la información botánica.</p>
                    </div>
                </div>

                <!-- Statistics Section -->
                <div class="bg-white rounded-xl shadow-xl p-8 mb-16">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-emerald-600">{{ App\Models\Especie::count() }}+</div>
                            <div class="text-gray-600">Especies Registradas</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-emerald-600">{{ App\Models\User::whereHas('roles', function ($query) {
                                $query->where('tipus_detalles', 'Taxonomo');
                                })->count() }}+</div>
                            <div class="text-gray-600">Expertos Taxónomos</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-emerald-600">{{ App\Models\User::all()->count() }}+</div>
                            <div class="text-gray-600">Usuarios Registrados</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-home-layout>
<x-home-layout>
    <main class="mt-6 bg-gradient-to-b from-green-100 to-green-300 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="text-center py-16">
                <h1 class="text-5xl font-bold text-green-800">Bienvenido a la Taxonomía de Flora</h1>
                <p class="mt-4 text-xl text-gray-700">
                    Explora, descubre y valida especies de plantas con nuestra plataforma. 
                </p>
                <div class="mt-8 flex justify-center gap-4">
                    <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md">
                        {{ __('Register') }}
                    </a>
                    <a href="{{ route('login') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md">
                        {{ __('Login') }}
                    </a>
                </div>
            </div>

            <!-- Features Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-green-700">Explora Especies</h3>
                    <p class="mt-2 text-gray-600">Accede a un catálogo completo de especies clasificadas por reinos, géneros y familias.</p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-green-700">Registra Nuevas Especies</h3>
                    <p class="mt-2 text-gray-600">Contribuye al conocimiento botánico registrando nuevas especies.</p>
                </div>
                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-green-700">Valida Información</h3>
                    <p class="mt-2 text-gray-600">Los taxónomos verifican y validan las especies registradas por los usuarios.</p>
                </div>
            </div>
        </div>
    </main>
</x-home-layout>

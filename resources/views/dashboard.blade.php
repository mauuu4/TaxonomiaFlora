<x-app-layout>
    <div class="py-12 bg-green-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Título Dinámico -->
                    <div class="mb-6 flex justify-between items-center">
                        <h1 class="text-2xl font-bold text-gray-800">
                            @if(Auth::user()->hasRole('Administrador'))
                                Panel de Administración
                            @elseif(Auth::user()->hasRole('Taxonomo'))
                                Panel de Taxonomo
                            @else
                                Mi Panel de Especies
                            @endif
                        </h1>
                    </div>

                    <!-- Mensaje de Bienvenida Personalizado -->
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 p-4">
                        <p class="text-green-700">
                            Bienvenido, {{ Auth::user()->user_nombre }} {{ Auth::user()->user_apellido }}. 
                            @if(Auth::user()->hasRole('Administrador'))
                                Tienes acceso total al sistema de gestión de especies.
                            @elseif(Auth::user()->hasRole('Taxonomo'))
                                Puedes validar y gestionar registros de especies.
                            @else
                                Puedes continuar registrando y explorando especies.
                            @endif
                        </p>
                    </div>

                    <!-- Tarjetas Estadísticas Dinámicas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Tarjetas específicas según el rol -->
                        @if (Auth::user()->hasRole('Administrador'))
                            {{-- Tarjetas de Administrador --}}
                            <x-dashboard-card 
                                title="Total Usuarios" 
                                :value="$totalUsuarios" 
                                icon="users" 
                                color="indigo" 
                                :link="route('admin.users.index')"
                            />
                            
                        @endif

                        {{-- Tarjeta común de Registros --}}
                        <x-dashboard-card 
                            title="Total Registros" 
                            :value="$totalRegistros" 
                            icon="database" 
                            color="green" 
                            :link="route('especies.index')"
                        />

                        @if (Auth::user()->hasRole('Taxonomo') || Auth::user()->hasRole('Administrador'))
                            <x-dashboard-card 
                                title="Total Familias" 
                                :value="$totalFamilias" 
                                icon="collection" 
                                color="blue" 
                                :link="route('familias.index')"
                            />
                            <x-dashboard-card 
                                title="Total Generos" 
                                :value="$totalGeneros" 
                                icon="database" 
                                color="gray" 
                                :link="route('generos.index')"
                            />
                            <x-dashboard-card 
                                title="Validaciones Pendientes" 
                                :value="$validacionesPendientes" 
                                icon="check-circle" 
                                color="yellow" 
                                :link="route('validate.index', ['estado' => 'Pendiente'])"
                            />
                        @endif

                        @if (Auth::user()->hasRole('Usuario'))
                            <x-dashboard-card 
                                title="Especies Validadas" 
                                :value="$especiesValidadas" 
                                icon="check-circle" 
                                color="green" 
                                :link="route('especies.index')"
                            />
                        @endif
                    </div>

                    <!-- Secciones Adicionales -->
                    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Registros Recientes o Pendientes -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                                    @if(Auth::user()->hasRole('Administrador'))
                                        Usuarios Más Activos
                                    @elseif(Auth::user()->hasRole('Taxonomo'))
                                        Registros Pendientes
                                    @else
                                        Mis Últimos Registros
                                    @endif
                                </h2>
                                
                                @if(Auth::user()->hasRole('Administrador'))
                                    <ul class="divide-y divide-gray-200">
                                        @foreach($usuariosMasActivos as $usuario)
                                            <li class="py-4 flex justify-between">
                                                <span>{{ $usuario->user_nombre }}</span>
                                                <span class="text-gray-500">{{ $usuario->registros_count }} registros</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @elseif(Auth::user()->hasRole('Taxonomo'))
                                    <ul class="divide-y divide-gray-200">
                                        @foreach($registrosPendientes as $registro)
                                            <li class="py-4 flex justify-between">
                                                <span>{{ $registro->especie->esp_nombre_cientifico }}</span>
                                                <span class="text-gray-500">{{ $registro->created_at->diffForHumans() }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul class="divide-y divide-gray-200">
                                        @foreach($ultimosRegistros as $registro)
                                            <li class="py-4 flex justify-between">
                                                <span>{{ $registro->especie->esp_nombre_cientifico }}</span>
                                                <span class="text-gray-500">{{ $registro->created_at->diffForHumans() }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>

                        <!-- Gráfico de Estado de Registros -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                                    Estado de Registros
                                </h2>
                                
                                <div class="space-y-2">
                                    @foreach($registrosPorEstado as $estado)
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">{{ $estado->regis_estado }}</span>
                                            <span class="text-sm font-bold">{{ $estado->count }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div 
                                                class="h-2.5 rounded-full 
                                                {{ $estado->regis_estado === 'Validado' ? 'bg-green-600' : 
                                                   ($estado->regis_estado === 'Pendiente' ? 'bg-yellow-600' : 'bg-red-600') }}"
                                            ></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
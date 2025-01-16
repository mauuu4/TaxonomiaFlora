<x-app-layout :nav="'dashboard'">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">
                            @if(Auth::user()->hasRole('admin'))
                                Panel de Administración
                            @elseif(Auth::user()->hasRole('taxonomist'))
                                Panel de Taxonomo
                            @else
                                Panel de Usuario
                            @endif
                        </h1>
                    </div>

                    <!-- Mensaje de Bienvenida -->
                    <div class="mb-6">
                        <p class="text-gray-600">
                            Bienvenido, {{ Auth::user()->user_nombre }} {{ Auth::user()->user_apellido }}.
                        </p>
                    </div>
        
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Card de Usuarios -->
                        @if (Auth::user()->hasRole('admin'))                          
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">
                                                Total Usuarios
                                            </p>
                                            <p class="text-2xl font-bold text-gray-900">
                                                {{ $totalUsuarios }}
                                            </p>
                                        </div>
                                        <div class="p-3 bg-indigo-100 rounded-full">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('admin.users.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                                            Ver todos los usuarios →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
        
                        <!-- Card de Especies -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">
                                            Total Registros de Especies
                                        </p>
                                        <p class="text-2xl font-bold text-gray-900">
                                            {{ $totalRegistros }}
                                        </p>
                                    </div>
                                    <div class="p-3 bg-green-100 rounded-full">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('especies.index') }}" class="text-sm text-green-600 hover:text-green-900">
                                        Ver todos los Registros →
                                    </a>
                                </div>
                            </div>
                        </div>
        
                        <!-- Card de Validaciones Pendientes -->
                        @if (Auth::user()->hasRole('taxonomist') || Auth::user()->hasRole('admin'))
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">
                                                Validaciones Pendientes
                                            </p>
                                            <p class="text-2xl font-bold text-gray-900">
                                                {{ $validacionesPendientes }}
                                            </p>
                                        </div>
                                        <div class="p-3 bg-yellow-100 rounded-full">
                                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('validate.index' , ['estado' => 'Pendiente']) }}" class="text-sm text-yellow-600 hover:text-yellow-900">
                                            Ver validaciones pendientes →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- Card de Especies Validadas -->
                        @if (Auth::user()->hasRole('user'))
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">
                                                Especies Validadas
                                            </p>
                                            <p class="text-2xl font-bold text-gray-900">
                                                {{ $especiesValidadas }}
                                            </p>
                                        </div>
                                        <div class="p-3 bg-green-100 rounded-full">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('especies.index') }}" class="text-sm text-green-600 hover:text-yellow-900">
                                            Ver especies validadas →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
        
                    <!-- Tabla de Últimas Actividades -->
                    @if(Auth::user()->hasRole('admin'))
                        <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                                    Últimas Actividades
                                </h2>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Usuario
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Acción
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Fecha
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($ultimasActividades as $actividad)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $actividad->user->user_nombre }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $actividad->descripcion }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $actividad->created_at->diffForHumans() }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

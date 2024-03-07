<x-app-layout>
    <x-slot name="header">
        <!-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>-->
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')">
                {{ __('Crear nueva tarea') }}
            </x-nav-link>
        </div>
    </x-slot>

    @if(session('success'))
    <div class="alert alert-success"
        style="background-color: #D4EDDA; color: #155724; border-color: #C3E6CB; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;">
        {{ session('success') }}
    </div>
    @endif

    <div class="py-12 flex justify-center">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <h1><strong>Crear Nueva Tarea</strong></h1>

                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <label for="title">Título:</label><br>
                        <input type="text" id="title" name="title" required maxlength="255"><br>

                        <!-- VALIDACION-->
                        @error('title')
                        <p>{{ $message }}</p>
                        @enderror

                        <label for="description">Descripción:</label><br>
                        <textarea id="description" name="description"></textarea><br>
                        <!-- {{ old('description') }} para mantener los datos introducidos con anterioridad -->
                        <label for="status">Estado:</label><br>
                        <select id="status" name="status" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="En proceso">En proceso</option>
                            <option value="Terminada">Terminada</option>
                        </select><br>

                        <!-- VALIDACION-->
                        @error('status')
                        <p>{{ $message }}</p>
                        @enderror


                        <label for="assigned_to">Asignar a:</label><br>
                        <select id="assigned_to" name="assigned_to" required>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            <!-- usuario selecciona a que usuario asignar la tarea -->
                            @endforeach
                        </select>

                        <!-- VALIDACION-->
                        @error('assigned_to')
                        <p>{{ $message }}</p>
                        @enderror
                        <br><br>

                        <x-primary-button type="submit">Crear Tarea</x-primary-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
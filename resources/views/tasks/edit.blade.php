<x-app-layout>
    <x-slot name="header">

    </x-slot>

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #D4EDDA; color: #155724; border-color: #C3E6CB; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   

                <h1><strong>Editar Tarea</strong></h1>

                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method ('PUT') <!--se utiliza el metodo PUT para enviar la solicitud-->
                        <label for="title">Título:</label><br>
                        <input type="text" id="title" name="title" value="{{ $task->title }}" required maxlength="255"><br>

                        <!-- VALIDACION-->
                        @error('title')
                        <p>{{ $message }}</p>
                        @enderror

                        <label for="description">Descripción:</label><br>
                        <textarea id="description" name="description">{{ $task->description }}</textarea><br> <!-- {{ old('description') }} para mantener los datos introducidos con anterioridad -->
                        <label for="status">Estado:</label><br>
                        
                        <select id="status" name="status" required>
                        @foreach($status as $statu)
                                <option value="{{ $statu }}" {{ $task->status == $statu ? 'selected' : '' }}>{{ $statu }}</option>
                         @endforeach
                        </select><br>

                        <!-- VALIDACION-->
                        @error('status')
                            <p>{{ $message }}</p>
                        @enderror


                        <label for="assigned_to">Asignar a:</label><br>
                        <select id="assigned_to" name="user_id" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>

                        <!-- VALIDACION-->
                        @error('assigned_to')
                            <p>{{ $message }}</p>
                        @enderror
                        <br><br>
            
                        <x-primary-button type="submit">Editar Tarea</x-primary-button>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
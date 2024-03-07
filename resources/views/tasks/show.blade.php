<x-app-layout>
    <x-slot name="header">

    </x-slot>

    @if(session('success'))
    <div class="alert alert-success"
        style="background-color: #D4EDDA; color: #155724; border-color: #C3E6CB; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto" style="padding: 30px">
        <table class="w-auto bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Título</th>
                    <th class="px-6 py-3 text-left">Descripción</th>
                    <th class="px-6 py-3 text-left">Estado</th>
                    <th class="px-6 py-3 text-left">Asignado a</th>
                    <th class="px-6 py-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($tasks as $task)
                <tr>
                    <td class="px-6 py-4">{{ $task->title }}</td>
                    <td class="px-6 py-4">{{ $task->description }}</td>
                    <td class="px-6 py-4">{{ $task->status }}</td>
                    <td class="px-6 py-4">{{ $task->user->name }}</td>

                    <td class="px-6 py-4">
                        <a href="{{ route('tasks.edit', $task->id) }}"
                            class="text-blue-500 hover:text-blue-700 mr-2">Editar</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <x-primary-button type="submit" class="text-red-500 hover:text-red-700">Eliminar
                            </x-primary-button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <!--   <div class="overflow-x-auto" style="padding: 30px">
        <table class="w-auto bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <th class="px-6 py-3 text-center">Tabla tareas pendientes</th>
                <td>
                </td>
            </thead>
            <tbody class="text-gray-700">
                @foreach($tasks as $task)
                @if($task->status == 'Pendiente')
                <tr>
                    <th class="px-6 py-3 text-left">Título</th>
                    <td class="px-6 py-4">{{ $task->title }}</td>
                </tr>
                <tr>
                    <th class="px-6 py-3 text-left">Descripción</th>
                    <td class="px-6 py-4">{{ $task->description }}</td>
                </tr>
                <tr>
                    <th class="px-6 py-3 text-left">Estado</th>
                    <td class="px-6 py-4">{{ $task->status }}</td>
                </tr>
                <tr>
                    <th class="px-6 py-3 text-left">Asignado a</th>
                    <td class="px-6 py-4">{{ $task->user->name }}</td>
                </tr>
                <tr>
                    <th class="px-6 py-3 text-left">Acciones</th>
                    <td class="px-6 py-4">
                        <a href="{{ route('tasks.edit', $task->id) }}"
                            class="text-blue-500 hover:text-blue-700 mr-2">Editar</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <x-primary-button type="submit" class="text-red-500 hover:text-red-700">Eliminar
                            </x-primary-button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach

            </tbody>
        </table>
    </div>
-->

</x-app-layout>
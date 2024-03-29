<x-app-layout>
    <x-slot name="header">

    </x-slot>

    @if(session('success'))
    <div class="alert alert-success"
        style="background-color: #D4EDDA; color: #155724; border-color: #C3E6CB; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto flex justify-center p-6">
        <table class="w-auto bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Título</th>
                    <th class="px-6 py-3 text-left">Descripción</th>
                    <th class="px-6 py-3 text-left">Estado</th>
                    <th class="px-6 py-3 text-left">Asignado a</th>
                    <th class="px-6 py-3 text-left">Creación</th>
                    <th class="px-6 py-3 text-left">Finalización</th>
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
                    <td class="px-6 py-4">{{ $task->created_at }}</td>
                    <td class="px-6 py-4">{{ $task->finished_at }}</td>

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
</x-app-layout>
<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
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
                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Editar</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
</table>
</div>
</x-app-layout>
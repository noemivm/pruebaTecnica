<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('tasks.index', ['users' => $users]);

    }

    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {

        //dd($request->all());

        /*$request->validate([
             'title' => 'required|string|max:255',
             'description' => 'nullable|string',
             'status' => 'required|in:Pendiente,En proceso,Terminada',
             'user_id' => 'required|exists:users,id'
         ]);*/

        $taskData = $request->all();

        if (strcasecmp($request->status, "Terminada") === 0) {
            $taskData['finished_at'] = Carbon::now();//hora y fecha actual al tener estado terminado
        }

        $taskData['user_id'] = $request->input('assigned_to'); // Asignar la tarea al usuario seleccionado
        Task::create($taskData);
        return redirect()->route('tasks.show')->with('success', 'Tarea creada exitosamente.');

    }

    public function edit(Task $task)
    {

        // Obtener todas las opciones del enum del modelo Task
        $statusOptions = Task::getStatusOptions();

        $users = User::all();
        //$tasks = Task::all();
        //$status = Task::pluck('status')->unique();//agrupar por unico estado
        //return view('tasks.edit', ['users' => $users, 'task' => $task, 'status' => $status]);
        return view('tasks.edit', ['users' => $users, 'task' => $task, 'statusOptions' => $statusOptions,]);
    }

    public function update(Request $request, Task $task)
    {


        /*$request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pendiente,En proceso,Terminada',
            'user_id' => 'required|exists:users,id'
        ]);*/
        if (strcasecmp($request->status, "Terminada") === 0) {
            $task->finished_at = Carbon::now();//hora y fecha actual al tener estado terminado
        }

        $task->update($request->all());
        return redirect()->route('tasks.show')->with('success', 'Tarea actualizada exitosamente.');
    }


    public function show()
    {

        $tasks = Task::with('user')->get();
        return view('tasks.show', ['tasks' => $tasks]);

    }


    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.show')->with('success', 'Tarea eliminada exitosamente.');
    }
}
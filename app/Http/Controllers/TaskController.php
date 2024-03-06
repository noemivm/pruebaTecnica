<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

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
        $taskData['user_id'] = $request->input('assigned_to'); // Asignar la tarea al usuario seleccionado
        Task::create($taskData);
        return redirect()->route('tasks.index')->with('success', 'Tarea creada exitosamente.');

    }

    public function edit(Task $task)    
    {
        $users = User::all(); 
        //$tasks = Task::all();
        $status = Task::pluck('status')->unique();//agrupar por unico estado
        return view('tasks.edit', ['users' => $users, 'task' => $task, 'status' => $status]); 
    }

    public function update(Request $request, Task $task)
    {
        /*$request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pendiente,En proceso,Terminada',
            'user_id' => 'required|exists:users,id'
        ]);*/

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada exitosamente.');
    }


    public function show() {
        
        $tasks = Task::with('user')->get();
        return view('tasks.show', ['tasks' => $tasks]);

    }


    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada exitosamente.');
    }
}
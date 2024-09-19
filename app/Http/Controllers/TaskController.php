<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = $this->getAllTasksByUser();

        if ($tasks->isEmpty()) {
            return view('home', ['tasks' => collect()]);
        }

        return view('home', ['tasks' => $tasks]);
    }


    public function store(Request $request){
        $validated = $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:3', 'max:255'],
            'category' => ['required', 'min:3', 'max:50'],
        ]);
        
        Task::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'status' => false,
        ]);

        return redirect()->route('home');
    }

    public function getAllTasksByUser(){
        $user_id = Auth::id();
        $tasks = DB::table('tasks')
            ->select()
            ->where('user_id', '=', $user_id)
            ->get();
        return $tasks;
    }

    public function getAllTasks(){
        $tasks = User::find(Auth::id())->tasks;

        return $tasks;
    }

    public function deleteTask($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->first();

        if ($task) {
            $task->delete();
            return redirect()->route('home')->with('success', 'Tarefa deletada com sucesso!');
        }

        return redirect()->route('home')->with('error', 'Tarefa não encontrada ou você não tem permissão para deletá-la.');
    }
    
    public function edit($id)
    {
        // Tenta encontrar a tarefa pelo ID e garantir que pertence ao usuário autenticado
        $task = Task::where('user_id', Auth::id())->findOrFail($id);

        // Retorna a view de edição, passando a tarefa para a view
        return view('editTask', compact('task'));
    }

    public function update(Request $request, $id)
    {
        // Valida os dados do formulário
        $validated = $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:3', 'max:255'],
            'category' => ['required', 'min:3', 'max:50'],
        ]);

        // Tenta encontrar a tarefa pelo ID e garantir que pertence ao usuário autenticado
        $task = Task::where('user_id', Auth::id())->findOrFail($id);

        // Atualiza a tarefa com os novos dados validados
        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
        ]);

        // Redireciona de volta para a página inicial com uma mensagem de sucesso
        return redirect()->route('home')->with('success', 'Task updated successfully!');
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['required', 'min:3', 'max:255'],
            'category' => ['required', 'min:3', 'max:50'],
        ]);
        
        dd(Task::create($validated));
        //dd($validated);        
        // $task = new Task();
        // $task->title = $validated['title'];
        // $task->description = $validated['description'];
        // $task->category = $category['category'];
        // $task->save();

        return redirect()->route('home');
    }

    public function getAllTasksByUserId(){
        $user_id = Auth::id();
        $tasks = DB::tables('tasks')
            ->select()
            ->where('user_id', '=', $user_id)
            ->get();

        dd($tasks);
    }
}

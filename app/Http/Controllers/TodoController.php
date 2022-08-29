<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'todos' => Todo::all()->map(function ($todo) {
                return [
                    'id' => $todo->id,
                    'name' => $todo->name,
                    'description' => $todo->description,
                    'priority' => $todo->priority,
                    'completed' => $todo->completed,
                ];
            })
        ]);
    }

    public function create(Request $request)
    {
        $request->request->add(['user_id' => auth()->id()]);

        Validator::make($request->all(), [
            'user_id' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'priority' => ['required'],
            'completed' => ['required'],
        ])->validate();

        Todo::create($request->all());

        return redirect()->back()->with('message', 'Todo Created Successfully.');
    }
}

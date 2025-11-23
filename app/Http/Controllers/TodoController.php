<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\ReportTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::join('report_titles as r', 'todos.title_id', '=', 'r.id')
             ->where('todos.is_completed', false)
             ->orderBy('todos.created_at', 'asc')
             ->get(['todos.id','todos.description', 'r.title', 'todos.created_by']);


        $titles = ReportTitle::all();

        return view('dashboard',compact('todos','titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('dashboard');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description'=>'required|string|max:255',
            'title_id'=>'required',
        ]);

        $validated['created_by'] = Auth::user()->name;


        Todo::create($validated);
        return redirect()->route('dashboard');

    }

    /**
     * Display the specified resource.
     */
    public function showSearch(Request $request)
    {
         $query = Todo::join('report_titles as r', 'todos.title_id', '=', 'r.id')
        ->where('todos.is_completed', true);

        // Filter by month
        if ($request->month) {
            $query->whereMonth('todos.created_at', $request->month);
        }

        // Filter by title
        if ($request->title_id) {
            $query->where('todos.title_id', $request->title_id);
        }

        $todos = $query
            ->orderBy('todos.created_at', 'asc')
            ->get(['todos.id', 'todos.description', 'r.title', 'todos.created_at']);

        $titles = ReportTitle::all();

        return view('search', compact('todos', 'titles'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('edit-modal');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $validated = $request->validate([
            'description'=>'required',
            'title_id'=>'required'
        ]);

        $todo->update($validated);

        return redirect()->back()->with('success', 'Task completed!');
    }

    public function completed(Request $request, Todo $todo)
    {
        $todo->update(['is_completed' => 1 ]);
        return redirect()->back()->with('success', 'Task completed!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();   // delete this specific record

        return redirect()->route('dashboard')->with('success', 'Task deleted!');
    }
}

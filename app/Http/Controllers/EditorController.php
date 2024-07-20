<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class EditorController extends Controller
{

    public function index()
    {
        $todos = Todo::all();
        return view('cdn-example', compact('todos'));
    }

    public function localExample()
    {
        $todos = Todo::all();
        return view('local-example', compact('todos'));
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $done = Todo::create($validated);

        if ($done) {
            return redirect()->route('home')->with('success');
        }
        return redirect()->route('home')->with('error');
    }

    public function destroy(Todo $todo){
        $todo->delete();
        return redirect()->route('home')->with('success');
        
    }
}

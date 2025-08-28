<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $notebooks = Notebook::where('user_id', $user_id)->paginate(5);
        return view("notebooks.index")->with('notebooks',$notebooks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notebooks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
                            'name'=>'required|max:120',
                            'order' => 'required|integer|min:1|max:9',
                        ]);
        $notebook = new Notebook([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'order' => $request->order,
        ]);
        $notebook->save();
        return view('notebooks.show',['notebook' => $notebook]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notebook $notebook)
    {
        if ($notebook->user_id !== Auth::id()) {
            abort(403);
        }
        return view('notebooks.show',['notebook' => $notebook]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notebook $notebook)
    {
        $this->authorize('view', $notebook);

        $notebooks = Auth::user()->notebooks;

        return view('notebooks.edit', compact('notebook', 'notebooks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notebook $notebook)
    {
        $request->validate([
            'name' => 'required|max:120',
            'order' => 'required|integer|min:1|max:9',
        ]);

        $notebook->name = $request->name;
        $notebook->order = $request->order;
        $notebook->update();

        return to_route('notebooks.show', $notebook)->with('success', 'Changes Saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notebook $notebook)
    {
        //
    }
}

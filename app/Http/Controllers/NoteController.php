<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Auth::user()->notes()->paginate(5);
        return view("notes.index")->with('notes',$notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notebooks = Auth::user()->notebooks;
        return view('notes.create', compact('notebooks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
                            'title'=>'required|max:120',
                            'text'=>'required',
                            'notebook_id'=>'required'
                        ]);

        $note = Auth::user()->notes()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'notebook_id' => $request->notebook_id,
            'text' => $request->text
        ]);

        return to_route('notes.show',['note' => $note])->with('success', 'Note Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if ($note->user()->isNot(Auth::user())) {
            abort(403);
        }
        return view('notes.show',['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if ($note->user()->isNot(Auth::user())) {
            abort(403);
        }
        $notebooks = Auth::user()->notebooks;
        return view('notes.edit',['note' => $note, 'notebooks' => $notebooks]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if ($note->user()->isNot(Auth::user())) {
            abort(403);
        }

        $request->validate([
                    'title'=>'required|max:120',
                    'text'=>'required',
                    'notebook_id'=>'required'
        ]);

        $note->update([
            'title' => $request->title,
            'notebook_id' => $request->notebook_id,
            'text' => $request->text
        ]);

        return to_route('notes.show',['note' => $note])->with('success', 'Changes Saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->user()->isNot(Auth::user())) {
            abort(403);
        }

        $note->delete();

        return to_route('notes.index')->with('success', 'Note moved to trash');
    }
}

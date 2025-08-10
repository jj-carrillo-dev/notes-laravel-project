<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // Get the collection of all notebooks for the authenticated user
        $notebooks = Auth::user()->notebooks;

        // Start the notes query
        $query = Auth::user()->notes()->latest();

        // Apply the filter if a notebook is selected
        if ($request->filled('notebook_id')) {
            $query->where('notebook_id', $request->notebook_id);
        }

        // Apply the search filter if a search term is provided
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Get the filtered notes
        $notes = $query->paginate(5);

        // Pass the variables to the view
        return view('notes.index', compact('notes', 'notebooks'));
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
    public function store(StoreNoteRequest $request)
    {
        $validated = $request->validated();
        
        $note = Auth::user()->notes()->create($validated);

        return to_route('notes.show', $note)->with('success', 'Note Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        $this->authorize('view', $note);

        return view('notes.show',['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $this->authorize('view', $note);

        $notebooks = Auth::user()->notebooks;

        return view('notes.edit', compact('note', 'notebooks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $this->authorize('update', $note);

        $note->update($request->validated());
        
        return to_route('notes.show', $note)->with('success', 'Changes Saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        $note->delete();

        return to_route('notes.index')->with('success', 'Note moved to trash');
    }
}

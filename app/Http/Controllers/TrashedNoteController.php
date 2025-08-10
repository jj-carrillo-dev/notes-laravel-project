<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashedNoteController extends Controller
{
    public function index(){
        $notes = Auth::user()->notes()->onlyTrashed()->latest('deleted_at')->paginate(5);
        return view("notes.index")->with('notes', $notes);
    }

    public function show(Note $note)
    {
        $this->authorize('view', $note); // Assumes 'view' policy is updated
        return view("notes.show")->with('note', $note);
    }

    public function update(Note $note)
    {
        $this->authorize('restore', $note); // Assumes 'restore' policy is created
        $note->restore();
        return to_route('notes.show', ['note' => $note])->with('success', 'Note restored');
    }

    public function destroy(Note $note)
    {
        $this->authorize('forceDelete', $note); // Assumes 'forceDelete' policy is created
        $note->forceDelete();
        return to_route('trashed.index')->with('success', 'Note deleted');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    
  public function index(Request $request)
{
    $query = $request->input('search');

    $notes = Note::where('user_id', auth()->id())
        ->when($query, function ($q) use ($query) {
            $q->where('note', 'like', '%' . $query . '%');
        })
        ->latest()
        ->paginate(12);

    return view('notes.index', compact('notes', 'query'));
}

   
    public function create()
    {
        return view('notes.create');
    }

   
    public function store(Request $request)
    {
        $data = $request->validate([
            'note' => ['required', 'string']
        ]);

        $data['user_id'] = $request->user()->id;
        $note = Note::create($data);

        return to_route('notes.show', $note)->with('message', 'Note was created');
    }

    
    public function show(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        return view('notes.show', ['note' => $note]);
    }

   
    public function edit(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        return view('notes.edit', ['note' => $note]);
    }

    
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        $data = $request->validate([
            'note' => ['required', 'string']
        ]);

        $note->update($data);

        return to_route('notes.show', $note)->with('message', 'Note was updated');
    }

 
    public function destroy(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        $note->delete();

        return to_route('notes.index')->with('message', 'Note was deleted');
    }
}

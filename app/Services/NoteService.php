<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteService {

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function createNote() 
    {
        $note = Note::create([
            'title' => $this->request->title,
            'description' => $this->request->description,
            'color' => $this->request->color,
            'pinned' => $this->request->pinned,
            'archived' => $this->request->archived,
            'label_id' => $this->request->label_id
        ]);

        return $note;
    }

    public function updateNote($id)
    {
        $note = Note::findorfail($id);

        $note->update([
            'title' => $this->request->title,
            'description' => $this->request->description,
            'color' => $this->request->color,
            'pinned' => $this->request->pinned,
            'archived' => $this->request->archived,
            'label_id' => $this->request->label_id
        ]);

        return $note;
    }

    public function archiveNote($id) 
    {
        $note = Note::findOrFail($id);

        if($note->archived) {
            $note->update(['archived' => 0]);
        } else {
            $note->update(['archived' => 1]);
        }

        return $note;
    }

    public function pinNote($id)
    {
        $note = Note::findOrFail($id);

        if($note->pinned) {
            $note->update(['pinned' => 0]);
        } else {
            $note->update(['pinned' => 1]);
        }

        return $note;
    }

}
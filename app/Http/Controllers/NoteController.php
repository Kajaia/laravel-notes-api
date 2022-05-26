<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    protected Request $request;
    protected NoteService $service;

    public function __construct(Request $request, NoteService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Note $note)
    {
        return NoteResource::collection($note->getNotesWithPagination($this->request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return new NoteResource($this->service->createNote());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return new NoteResource($note->getSpecificNote($note->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Note $note)
    {
        return new NoteResource($this->service->updateNote($note->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        return response()->json(Note::findorfail($note->id)->delete());
    }

    /**
     * Get soft deleted notes
     */
    public function trash() {
        return NoteResource::collection(Note::onlyTrashed()->get());
    }

    /**
     * Restore deleted note
     */
    public function restore($id)
    {
        return response()->json(Note::withTrashed()->find($id)->restore());
    }

    /**
     * Archive or unarchive note
     */
    public function archive($id) {
        return $this->service->archiveNote($id);
    }

    /**
     * Pin or unpin note
     */
    public function pin($id) {
        return $this->service->pinNote($id);
    }
}

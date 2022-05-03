<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notes = Note::orderBy($request->orderBy ?? 'created_at', $request->orderDirection ?? 'desc')
            ->when($request->search, function($query) use ($request) {
                $query->where('title', 'LIKE', "%$request->search%");
            })
            ->when($request->boolean('pinned'), function($query) use ($request) {
                $query->where('pinned', $request->boolean('pinned'));
            })
            ->when($request->boolean('archived'), function($query) use ($request) {
                $query->where('archived', $request->boolean('archived'));
            })
            ->paginate($request->perPage ?? 10);

        return NoteResource::collection($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = Note::create([
            'title' => $request->title,
            'description' => $request->description,
            'color' => $request->color,
            'pinned' => $request->pinned,
            'archived' => $request->archived,
            'label_id' => $request->label_id
        ]);

        return new NoteResource($note);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::findorfail($id);

        return new NoteResource($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $note = Note::findorfail($id);

        $note->update([
            'title' => $request->title,
            'description' => $request->description,
            'color' => $request->color,
            'pinned' => $request->pinned,
            'archived' => $request->archived,
            'label_id' => $request->label_id
        ]);

        return new NoteResource($note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::findorfail($id);

        $note->delete();

        return [
            'removed' => true
        ];
    }

    public function trash() {
        $notes = Note::onlyTrashed()
            ->get();

        return NoteResource::collection($notes);
    }

    public function restore($id)
    {
        $note = Note::withTrashed()
            ->find($id)
            ->restore();

        return [
            'restored' => $note
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'color',
        'pinned',
        'archived',
        'label_id'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function label() {
        return $this->belongsTo(Label::class);
    }

    public function getNotesWithPagination(Request $request) {
        return $this->orderBy($request->orderBy ?? 'pinned', $request->orderDirection ?? 'desc')
            ->where('archived', false)
            ->when($request->search, function($query) use ($request) {
                $query->where('title', 'LIKE', "%$request->search%");
            })->paginate($request->perPage ?? 10);
    }

    public function getSpecificNote($id) {
        return $this->findorfail($id);
    }
}

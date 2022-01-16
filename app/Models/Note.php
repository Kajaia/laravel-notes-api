<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;

class Note extends Model
{
    use HasFactory, SoftDeletes, Filterable;

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
}

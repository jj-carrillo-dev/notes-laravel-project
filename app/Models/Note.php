<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getRouteKeyName(){
        return 'uuid';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($note) {
            $note->uuid = (string) Str::uuid();
        });
    }

    /**
     * Get the user that owns the note.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Get the notebook that owns the note.
     */
    public function notebook(){
        return $this->belongsTo(Notebook::class);
    }
}

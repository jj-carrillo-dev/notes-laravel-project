<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];

    public function getRouteKeyName(){
        return 'uuid';
    }

    /**
     * Get the notebook that owns the note.
     */
    public function notebook()
    {
        return $this->belongsTo(Notebook::class);
    }
}

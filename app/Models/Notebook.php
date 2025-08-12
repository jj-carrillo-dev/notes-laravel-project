<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name'
    ];

    /**
     * Get the user that owns the notebook.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

}

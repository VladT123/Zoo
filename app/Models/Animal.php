<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    protected $fillable = ['name', 'species', 'cage_id','description','age'];

    public function cage(): BelongsTo
    {
        return $this->belongsTo(Cage::class);
    }
}

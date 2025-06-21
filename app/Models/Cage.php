<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cage extends Model
{
    protected $fillable = ['name', 'volume'];

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}

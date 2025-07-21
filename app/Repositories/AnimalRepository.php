<?php

namespace App\Repositories;


use App\Models\Animal;
use App\Models\Cage;

class AnimalRepository
{


    public function paginate($perPage = 10)
    {
        return  Animal::with('cage')->paginate($perPage);
    }

    public function count()
    {
        return  Animal::all()->count();
    }


}

<?php

namespace App\Repositories;

use App\Models\Cage;
use Illuminate\Database\Eloquent\Model;

class CageRepository
{

    public function paginate($perPage = 10)
    {
        return  Cage::with('animals')->paginate($perPage);
    }

    public function update(int $id, array $data)
    {
        $cage = Cage::findOrFail($id);
        $cage->update($data);
        return $cage;
    }

}

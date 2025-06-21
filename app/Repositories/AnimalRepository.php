<?php

namespace App\Repositories;

//use App\Models\Cage;
//use App\Models\Order;
//use App\Models\Ware;
//use App\Repositories\DTO\OrderDTO;
//use App\Repositories\DTO\WareDTO;

// Replace with your actual model

use App\Models\Animal;
use App\Models\Cage;

class AnimalRepository
{
//    public function all()
//    {
//        return Ware::all();
//    }
//
//    public function find($id)
//    {
//        return Ware::findOrFail($id);
//    }

    public function paginate($perPage = 10)
    {
        return  Animal::with('cage')->paginate($perPage);
    }

//
//    public function create(WareDTO $wareDTO)
//    {
//        Ware::create([
//            'title' => $wareDTO->title,
//            'description' => $wareDTO->description,
//            'price' => $wareDTO->price,
//            'category_id' => $wareDTO->category_id,
//        ]);
//    }
//
//    public function update(Ware $ware, WareDTO $wareDTO)
//    {
//        $ware->update([
//            'title' => $wareDTO->title,
//            'description' => $wareDTO->description,
//            'price' => $wareDTO->price,
//            'category_id' => $wareDTO->category_id,
//        ]);
//    }
//
//    public function delete(Ware $ware)
//    {
//        $ware->delete();
//    }

}

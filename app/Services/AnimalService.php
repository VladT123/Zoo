<?php

namespace App\Services;

use App\Models\Animal;
use App\Models\Cage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AnimalService
{
    public function create(array $data): Model
    {
        if (!empty($data['cage_id'])) {
            $cage = Cage::findOrFail($data['cage_id']);
            $this->validateCageCapacity($cage);
        }
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $imagePath = $data['image']->store('animal_images', 'public');
            $data['image_path'] = $imagePath;
            unset($data['image']); // Remove the image file object from data array
        }
        return Animal::create($data);
    }

    public function update(int $id, array $data): Model
    {
        $animal = Animal::findOrFail($id);
        if (!empty($data['cage_id']) && $data['cage_id'] != $animal->cage_id) {
            $cage = Cage::findOrFail($data['cage_id']);
            $this->validateCageCapacity($cage);
        }

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $imagePath = $data['image']->store('animal_images', 'public');
            $data['image_path'] = $imagePath;
            unset($data['image']);
        } elseif (!array_key_exists('image', $data) && $animal->image_path) {
            Storage::disk('public')->delete($animal->image_path);
            $data['image_path'] = null;
        }

        $animal->update($data);

        return $animal;
    }

    protected function validateCageCapacity(Cage $cage): void
    {
        $currentAnimalsCount = $cage->animals()->count();

        if ($currentAnimalsCount >= $cage->volume) {
            throw new \RuntimeException('The selected cage is already at full capacity');
        }
    }
}

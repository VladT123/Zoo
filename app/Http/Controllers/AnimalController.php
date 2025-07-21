<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
//use App\Http\Requests\StoreWareRequest;
//use App\Http\Requests\UpdateWareRequest;
//use App\Models\Category;
//use App\Models\Ware;
//use App\Repositories\CageRepository;
//use App\Repositories\CategoryRepository;
//use App\Repositories\DTO\WareDTO;
//use App\Repositories\OrderRepository;
//use App\Repositories\WareRepository;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Models\Animal;
use App\Models\Cage;
use App\Repositories\AnimalRepository;
use App\Repositories\CageRepository;
use App\Services\AnimalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AnimalController extends Controller
{

    public function index(AnimalRepository $animalRepository): View
    {
        $animals = $animalRepository->paginate();
        return view('animals.index', compact('animals'));
    }

    public function create(Request $request)
    {
        $cages = Cage::all();
        $selectedCage = $request->has('cage_id')
            ? Cage::find($request->input('cage_id'))
            : null;

        return view('animals.create', [
            'cages' => $cages,
            'selectedCageId' => $selectedCage ? $selectedCage->id : null
        ]);
    }

    public function store(StoreAnimalRequest $request, AnimalService $animalService): RedirectResponse
    {
        try {
            $animal = $animalService->create($request->validated());

            return redirect()
                ->route('animals.show', $animal->id)
                ->with('success', 'Animal created successfully');

        } catch (\RuntimeException $e) {
            return back()
                ->withInput()
                ->withErrors(['cage_id' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        $animal = Animal::with('cage')->findOrFail($id);
        return view('animals.show', compact('animal'));
    }

    public function edit($id)
    {
        $animal = Animal::findOrFail($id);
        $cages = Cage::all();
        return view('animals.edit', compact('animal', 'cages'));
    }

    public function update(UpdateAnimalRequest $request,AnimalService $animalService, $id)
    {
        try {
            $animal = $animalService->update($id, $request->validated());

            return redirect()
                ->route('animals.show', $animal->id)
                ->with('success', 'Animal updated successfully');

        } catch (\RuntimeException $e) {
            return back()
                ->withInput()
                ->withErrors(['cage_id' => $e->getMessage()]);
        }
    }

    public function destroy(Animal $animal){
        $animal->delete();
        return redirect(route('zoo.index', absolute: false));
    }
}

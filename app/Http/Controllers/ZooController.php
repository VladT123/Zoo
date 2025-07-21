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
use App\Http\Requests\StoreCageRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Http\Requests\UpdateCageRequest;
use App\Models\Animal;
use App\Models\Cage;
use App\Repositories\AnimalRepository;
use App\Repositories\CageRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ZooController extends Controller
{

    public function index(CageRepository $cageRepository, AnimalRepository $animalRepository): View
    {
        $cages = $cageRepository->paginate();
        $population = $animalRepository->count();
        return view('zoo.index', compact('cages', 'population'));
    }

    public function edit($id)
    {
        $cage = Cage::findOrFail($id);
        return view('zoo.edit', compact('cage'));
    }

    public function update(UpdateCageRequest $request, CageRepository $cageRepository, $id)
    {
        $cage = $cageRepository->update($id, $request->validated());
        return redirect()->route('zoo.show', $cage->id)
            ->with('success', 'Cage updated successfully');
    }

    public function create()
    {
        return view('zoo.create');
    }

    public function store(StoreCageRequest $request)
    {
        $cage = Cage::create($request->validated());

        return redirect()
            ->route('zoo.show', $cage->id)
            ->with('success', 'Cage created successfully');
    }

    public function show($id)
    {
        $cage = Cage::with('animals')->findOrFail($id);
        return view('zoo.show', compact('cage'));
    }


    public function destroy(Cage $cage): RedirectResponse
    {
        $cage->delete();
        return redirect(route('zoo.index', absolute: false));
    }
}

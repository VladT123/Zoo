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
use App\Models\Animal;
use App\Models\Cage;
use App\Repositories\AnimalRepository;
use App\Repositories\CageRepository;
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
//
//    public function create(CategoryRepository $categoryRepository): View
//    {
//        $categories = $categoryRepository->all();
//        return view('ware.create', compact('categories'));
//    }
//
//    public function store(StoreWareRequest $request,WareRepository $wareRepository): RedirectResponse
//    {
//        $wareRepository->create(new WareDTO(
//            title: $request->title,
//            description: $request->description??null,
//            price: $request->price,
//            category_id: $request->category_id
//        ));
//
//        return redirect()->route('ware.index')->with('success', 'Ware created successfully');
//    }
//
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'cage_id' => 'nullable|exists:cages,id',
            'description' => 'nullable|string'
        ]);

        // Check if cage_id is provided and validate cage capacity
        if (!empty($validated['cage_id'])) {
            $cage = Cage::findOrFail($validated['cage_id']);
            $currentAnimalsCount = $cage->animals()->count();

            if ($currentAnimalsCount >= $cage->volume) {
                return back()
                    ->withInput()
                    ->withErrors(['cage_id' => 'The selected cage is already at full capacity']);
            }
        }

        $animal = Animal::create($validated);

        return redirect()->route('animals.show', $animal->id)
            ->with('success', 'Animal created successfully');
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

    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'cage_id' => 'nullable|exists:cages,id',
            'description' => 'nullable|string'
        ]);

        $animal->update($validated);

        return redirect()->route('animals.show', $animal->id)
            ->with('success', 'Animal updated successfully');
    }
//
//    public function edit(Ware $ware, CategoryRepository $categoryRepository): View
//    {
//        $categories = $categoryRepository->all();
//        return view('ware.edit', compact('ware', 'categories'));
//    }
//
//    public function update(UpdateWareRequest $request, Ware $ware, WareRepository $wareRepository): RedirectResponse
//    {
//        $wareRepository->update($ware,new WareDTO(
//            title: $request->title,
//            description: $request->description??null,
//            price: $request->price,
//            category_id: $request->category_id
//        ));
//        return redirect()->route('ware.index')->with('success', 'Ware updated successfully');
//    }
//
//    public function destroy(Ware $ware, WareRepository $wareRepository): RedirectResponse
//    {
//        $wareRepository->delete($ware);
//        return redirect()->route('ware.index')->with('success', 'Ware deleted successfully');
//    }
}

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
use App\Repositories\CageRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ZooController extends Controller
{

    public function index(CageRepository $cageRepository): View
    {
        $cages = $cageRepository->paginate();
        return view('zoo.index', compact('cages'));
    }
    public function edit($id)
    {
        $cage = Cage::findOrFail($id);
        return view('zoo.edit', compact('cage'));
    }

    public function update(Request $request, $id)
    {
        $cage = Cage::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'volume' => 'required|integer|min:1'
        ]);

        $cage->update($validated);

        return redirect()->route('zoo.show', $cage->id)
            ->with('success', 'Cage updated successfully');
    }

    public function create()
    {
        return view('zoo.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'volume' => 'required|integer|min:1'
        ]);

        $cage = Cage::create($validated);

        return redirect()->route('zoo.show', $cage->id)
            ->with('success', 'Cage created successfully');
    }
    public function show($id)
    {
        $cage = Cage::with('animals')->findOrFail($id);
        return view('zoo.show', compact('cage'));
    }

//
//    public function destroy(Ware $ware, WareRepository $wareRepository): RedirectResponse
//    {
//        $wareRepository->delete($ware);
//        return redirect()->route('ware.index')->with('success', 'Ware deleted successfully');
//    }
}

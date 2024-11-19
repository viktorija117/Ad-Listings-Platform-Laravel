<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\DestroyLocationRequest;
use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(StoreLocationRequest $request)
    {
        Location::create($request->validated());

        return redirect()->route('locations.index')->with('success', 'Lokacija uspešno kreirana.');
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        // Proveru da li lokacija ima oglase sada možemo obaviti u request klasi ako je potrebno.
        if ($location->ads()->count() > 0) {
            return redirect()->route('locations.index')->with('error', 'Ne možete urediti lokaciju jer ima povezane oglase.');
        }

        $location->update($request->validated());

        return redirect()->route('locations.index')->with('success', 'Lokacija uspešno ažurirana.');
    }

    public function destroy(DestroyLocationRequest $request, Location $location)
    {
        $location->delete();

        return redirect()->route('locations.index')->with('success', 'Lokacija uspešno obrisana.');
    }
}

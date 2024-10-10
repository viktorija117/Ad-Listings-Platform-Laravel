<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Location::create([
            'name' => $request->name,
        ]);

        return redirect()->route('locations.index')->with('success', 'Lokacija uspešno kreirana.');
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        // Ako lokacija ima oglase, zabrani edit
        if ($location->ads()->count() > 0) {
            return redirect()->route('locations.index')->with('error', 'Ne možete urediti lokaciju jer ima povezane oglase.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $location->update([
            'name' => $request->name,
        ]);

        return redirect()->route('locations.index')->with('success', 'Lokacija uspešno ažurirana.');
    }

    public function destroy(Location $location)
    {
        // Ako lokacija ima oglase, zabrani brisanje
        if ($location->ads()->count() > 0) {
            return redirect()->route('locations.index')->with('error', 'Ne možete obrisati lokaciju jer ima povezane oglase.');
        }
        $location->delete();

        return redirect()->route('locations.index')->with('success', 'Lokacija uspešno obrisana.');
    }

}

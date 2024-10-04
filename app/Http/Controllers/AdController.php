<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdImage;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $query = Ad::query();

        // Filtriranje po kategoriji
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filtriranje po lokaciji
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        // Sortiranje po ceni
        if ($request->filled('sort_by')) {
            if ($request->sort_by == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort_by == 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        }

        // Učitaj oglase sa filtrima i sortiranjem
        $ads = $query->get();

        // Učitaj sve kategorije i lokacije za prikaz u formi
        $categories = Category::all();
        $locations = Location::all();

        return view('ads.index', compact('ads', 'categories', 'locations'));
    }


    public function create(): View|RedirectResponse
    {
        // Proveri da li korisnik ima dozvolu za kreiranje oglasa
        if (!auth()->user()->can('create', Ad::class)) {
            return redirect()->route('ads.index')->with('error', 'Nemate dozvolu za kreiranje oglasa.');
        }

        $categories = Category::all();
        $locations = Location::all();
        return view('ads.create', compact('categories', 'locations'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Proveri da li korisnik ima dozvolu za kreiranje oglasa
        if (!auth()->user()->can('create', Ad::class)) {
            return redirect()->route('ads.index')->with('error', 'Nemate dozvolu za kreiranje oglasa.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Kreiranje oglasa
        $ad = new Ad($request->all());
        $ad->user_id = auth()->id();
        $ad->save();

        // Upload i čuvanje više slika
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('ads', 'public');
                AdImage::create([
                    'ad_id' => $ad->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('ads.index')->with('success', 'Oglas uspešno postavljen.');
    }

    public function show(Ad $ad)
    {
        return view('ads.show', compact('ad'));
    }

 /*   public function edit(Ad $ad)
    {
        // Proveri da li korisnik može urediti ovaj oglas (vlasnik ili admin)
        if (!auth()->user()->can('update', $ad)) {
            return redirect()->route('ads.index')->with('error', 'Nemate dozvolu za uređivanje ovog oglasa.');
        }

        $categories = Category::all();
        $locations = Location::all();

        return view('ads.edit', compact('ad', 'categories', 'locations'));
    }
*/
/*    public function update(Request $request, Ad $ad)
    {
        // Proveri da li korisnik može ažurirati ovaj oglas
        if (!auth()->user()->can('update', $ad)) {
            return redirect()->route('ads.index')->with('error', 'Nemate dozvolu za ažuriranje ovog oglasa.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'location_id' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $ad->update($request->all());

        // Upload i čuvanje novih slika
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('ads', 'public');
                AdImage::create([
                    'ad_id' => $ad->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('ads.index')->with('success', 'Oglas uspešno ažuriran.');
    }
*/
    public function destroyImage(Ad $ad, AdImage $image)
    {
        // Proveri da li korisnik može obrisati slike (vlasnik ili admin)
        if (!auth()->user()->can('delete', $ad)) {
            return redirect()->route('ads.index')->with('error', 'Nemate dozvolu za brisanje slika oglasa.');
        }

        if (Storage::exists('public/' . $image->image_path)) {
            Storage::delete('public/' . $image->image_path);
        }

        $image->delete();

        return redirect()->back()->with('success', 'Slika uspešno obrisana.');
    }

    public function destroy(Ad $ad)
    {
        // Proveri da li korisnik može obrisati ovaj oglas
        if (!auth()->user()->can('delete', $ad)) {
            return redirect()->route('ads.index')->with('error', 'Nemate dozvolu za brisanje ovog oglasa.');
        }

        $ad->delete();
        return redirect()->route('ads.index')->with('success', 'Oglas uspešno obrisan.');
    }

    public function search(Request $request)
    {
        $query = Ad::query();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $ads = $query->get();

        return view('ads.index', compact('ads'));
    }

    public function myAds()
    {
        // Prikaz oglasa trenutnog korisnika
        $ads = Ad::where('user_id', auth()->id())->with('category', 'location')->get();
        return view('ads.my-ads', compact('ads'));
    }
}



<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdImage;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $ads = Ad::with('category', 'location', 'user')->get();
        return view('ads.index', compact('ads'));
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('ads.create', compact('categories', 'locations'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
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

    public function edit(Ad $ad)
    {
        if (auth()->user()->id !== $ad->user_id && !auth()->user()->isAdmin()) {
            return redirect()->route('ads.index')->with('error', 'Nemate dozvolu za uređivanje ovog oglasa.');
        }

        $categories = Category::all();
        $locations = Location::all();

        return view('ads.edit', compact('ad', 'categories', 'locations'));
    }


    public function update(Request $request, Ad $ad)
    {
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

    public function destroyImage(Ad $ad, AdImage $image)
    {
        if (Storage::exists('public/' . $image->image_path)) {
            Storage::delete('public/' . $image->image_path);
        }

        $image->delete();

        return redirect()->back()->with('success', 'Slika uspešno obrisana.');
    }



    public function destroy(Ad $ad)
    {
        if (auth()->user()->id !== $ad->user_id && !auth()->user()->isAdmin()) {
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
        $ads = Ad::where('user_id', auth()->id())->with('category', 'location')->get();
        return view('ads.my-ads', compact('ads'));
    }


}


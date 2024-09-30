<!-- resources/views/ads/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pregled svih oglasa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Dostupni oglasi</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($ads as $ad)
                        <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                @foreach ($ad->images as $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Slika oglasa" class="w-full h-64 object-cover">
                                @endforeach
                            </div>
                            <h4 class="text-xl font-semibold">{{ $ad->title }}</h4>
                            <p class="text-gray-700">{{ $ad->description }}</p>
                            <p class="text-gray-900 font-bold">{{ $ad->price }} RSD</p>
                            <p class="text-gray-600">Lokacija: {{ $ad->location->name }}</p>
                            <p class="text-gray-600">Kategorija: {{ $ad->category->name }}</p>

                            <a href="{{ route('ads.show', $ad) }}" class="mt-2 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                                Pogledaj detalje
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

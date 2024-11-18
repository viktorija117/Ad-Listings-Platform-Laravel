<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pregled svih oglasa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('error'))
                    <div class="alert alert-danger bg-red-700">
                        {{ session('error') }}
                    </div>
                @endif
                <h3 class="text-2xl font-bold mb-4">Dostupni oglasi</h3>

                    <!-- Filter i sortiranje -->
                    <form action="{{ route('ads.index') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Kategorije -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategorija</label>
                                <select name="category_id" id="category_id" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Sve kategorije</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Lokacije -->
                            <div>
                                <label for="location_id" class="block text-sm font-medium text-gray-700">Lokacija</label>
                                <select name="location_id" id="location_id" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Sve lokacije</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sortiranje po ceni -->
                            <div>
                                <label for="sort_by" class="block text-sm font-medium text-gray-700">Sortiraj po ceni</label>
                                <select name="sort_by" id="sort_by" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Bez sortiranja</option>
                                    <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Cena (rast)</option>
                                    <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Cena (pad)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                                Primeni filter
                            </button>
                        </div>
                    </form>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($ads as $ad)
                        <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                            <div x-data="{ currentImage: 0 }" class="relative">
                                <div class="relative overflow-hidden w-full h-64">
                                    <!-- Prikaz slika -->
                                    @foreach ($ad->images as $index => $image)
                                        <img
                                            x-show="currentImage === {{ $index }}"
                                            src="{{ asset('storage/' . $image->image_path) }}"
                                            alt="Slika oglasa"
                                            class="w-full h-64 object-cover"
                                            x-cloak
                                        >
                                    @endforeach
                                </div>

                                <!-- Leva strelica -->
                                <button @click="currentImage = currentImage === 0 ? {{ $ad->images->count() - 1 }} : currentImage - 1"
                                        class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-1 rounded-full hover:bg-gray-700">
                                    &larr;
                                </button>

                                <!-- Desna strelica -->
                                <button @click="currentImage = currentImage === {{ $ad->images->count() - 1 }} ? 0 : currentImage + 1"
                                        class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-1 rounded-full hover:bg-gray-700">
                                    &rarr;
                                </button>
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

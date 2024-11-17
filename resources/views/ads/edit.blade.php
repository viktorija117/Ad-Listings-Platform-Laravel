<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Uredi oglas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('ads.update', $ad) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Naslov -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Naslov</label>
                        <input type="text" name="title" id="title" value="{{ $ad->title }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Opis -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Opis</label>
                        <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $ad->description }}</textarea>
                    </div>

                    <!-- Cena -->
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Cena</label>
                        <input type="number" name="price" id="price" value="{{ $ad->price }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Kategorija -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategorija</label>
                        <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $ad->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Lokacija -->
                    <div class="mb-4">
                        <label for="location_id" class="block text-sm font-medium text-gray-700">Lokacija</label>
                        <select name="location_id" id="location_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ $ad->location_id == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Postojeće slike -->
                    <div class="mb-4">
                        <p class="block text-sm font-medium text-gray-700">Postojeće slike:</p>
                        @foreach($ad->images as $image)
                            <div class="flex items-center mb-2">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Slika oglasa" class="w-16 h-16 object-cover mr-2">
                                <form action="{{ route('ads.image.destroy', ['ad' => $ad, 'image' => $image]) }}" method="POST" onsubmit="return confirm('Da li ste sigurni da želite obrisati ovu sliku?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Obriši</button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <!-- Nove slike -->
                    <div class="mb-4">
                        <label for="images" class="block text-sm font-medium text-gray-700">Dodaj nove slike</label>
                        <input type="file" name="images[]" id="images" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                        Ažuriraj oglas
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

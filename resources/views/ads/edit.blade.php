<!-- resources/views/ads/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Uredi oglas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('ads.update', $ad) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Naslov</label>
                        <input type="text" name="title" id="title" value="{{ $ad->title }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Opis</label>
                        <textarea name="description" id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $ad->description }}</textarea>
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Cena</label>
                        <input type="number" name="price" id="price" value="{{ $ad->price }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategorija</label>
                        <select name="category_id" id="category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $ad->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="location_id" class="block text-sm font-medium text-gray-700">Lokacija</label>
                        <select name="location_id" id="location_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ $ad->location_id == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700">Dodaj nove slike</label>
                        <input type="file" name="images[]" id="images" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" multiple>
                    </div>

                    <div class="mt-4">
                        <h4 class="font-semibold text-lg">Trenutne slike</h4>
                        <form action="{{ route('ads.image.destroy', [$ad, $image]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700">
                                Obriši sliku
                            </button>
                        </form>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700">
                        Ažuriraj oglas
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

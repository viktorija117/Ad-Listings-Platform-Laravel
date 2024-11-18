<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Moji oglasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Oglasi koje ste postavili</h3>

                @if($ads->isEmpty())
                    <p class="text-gray-600">Nemate postavljenih oglasa.</p>
                @else
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

                                <!-- Dugme za izmenu -->
                                <a href="{{ route('ads.edit', $ad) }}" class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                                    Izmeni oglas
                                </a>

                                <!-- Dugme za brisanje -->
                                <form action="{{ route('ads.destroy', $ad) }}" method="POST" class="inline-block mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700">
                                        Obriši oglas
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

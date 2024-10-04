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
                @if(session('error'))
                    <div class="alert alert-danger bg-red-700">
                        {{ session('error') }}
                    </div>
                @endif
                <h3 class="text-2xl font-bold mb-4">Dostupni oglasi</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($ads as $ad)
                        <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                            <div x-data="{ currentImage: 0 }" class="relative">
                                <div class="relative overflow-hidden w-full h-64">
                                    <!-- Prikaz slika, samo jedna slika je prikazana u bilo kom trenutku -->
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

                            <!-- Prikaz opcija za uređivanje, brisanje i slanje poruka -->
                            @if (auth()->user()->isAn('admin'))
                                <!-- Prikaz opcije za uređivanje oglasa -->
                                <a href="{{ route('ads.edit', $ad) }}" class="mt-2 inline-block px-4 py-2 bg-blue-800 text-white rounded-lg shadow-md hover:bg-blue-700"
                                >Uredi</a>
                            @endif

                            @if (auth()->user()->isAn('admin'))
                                <!-- Prikaz opcije za brisanje oglasa -->
                                <form action="{{ route('ads.destroy', $ad) }}" method="POST" onsubmit="return confirm('Da li ste sigurni da želite obrisati ovaj oglas?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-2 inline-block px-4 py-2 bg-red-800 text-white rounded-lg shadow-md hover:bg-red-700"
                                    >Obriši</button>
                                </form>
                            @endif

                            @if(auth()->user()->can('send-messages', $ad))
                                <!-- Prikaz opcije za slanje poruke vlasniku oglasa -->
                                <a href="{{ route('messages.create', $ad) }}" class="mt-2 inline-block px-4 py-2 bg-green-800 text-white rounded-lg shadow-md hover:bg-green-700"
                                >Pošalji poruku</a>
                            @endif

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

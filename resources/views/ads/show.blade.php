<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prikaz oglasa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Prikaz slike oglasa -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    @foreach ($ad->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Slika oglasa" class="w-full h-64 object-cover">
                    @endforeach
                </div>
                <h3 class="text-2xl font-bold mb-4">{{ $ad->title }}</h3>
                <p class="text-gray-700">{{ $ad->description }}</p>
                <p class="text-gray-900 font-bold">{{ $ad->price }} RSD</p>
                <p class="text-gray-600">Kategorija: {{ $ad->category->name }}</p>
                <p class="text-gray-600">Lokacija: {{ $ad->location->name }}</p>
                <p class="text-gray-600">Postavio/la: {{ $ad->user->name }}</p>

                <!-- Ako je vlasnik oglasa -->
                @if(auth()->user()->id === $ad->user_id)
                    <a href="{{ route('ads.edit', $ad) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg shadow-md hover:bg-yellow-700">
                        Uredi oglas
                    </a>
                    <form action="{{ route('ads.destroy', $ad) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700">
                            Obriši oglas
                        </button>
                    </form>
                @else
                    <!-- Ako nije vlasnik oglasa -->
                    <a href="{{ route('messages.create', $ad) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                        Pošalji poruku prodavcu
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>




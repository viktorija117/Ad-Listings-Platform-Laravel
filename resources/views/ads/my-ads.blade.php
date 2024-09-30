<!-- resources/views/ads/my-ads.blade.php -->

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
                                <h4 class="text-xl font-semibold">{{ $ad->title }}</h4>
                                <p class="text-gray-700">{{ $ad->description }}</p>
                                <p class="text-gray-900 font-bold">{{ $ad->price }} RSD</p>
                                <p class="text-gray-600">Lokacija: {{ $ad->location->name }}</p>
                                <p class="text-gray-600">Kategorija: {{ $ad->category->name }}</p>

                                <a href="{{ route('ads.edit', $ad) }}" class="mt-2 inline-block px-4 py-2 bg-yellow-600 text-white rounded-lg shadow-md hover:bg-yellow-700">
                                    Uredi oglas
                                </a>

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

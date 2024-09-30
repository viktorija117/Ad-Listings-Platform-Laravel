<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lokacije') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('locations.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700">
                    Dodaj novu lokaciju
                </a>

                <div class="mt-6">
                    @if($locations->isEmpty())
                        <p class="text-gray-600">Nema dostupnih lokacija.</p>
                    @else
                        <ul class="list-disc list-inside">
                            @foreach($locations as $location)
                                <li>{{ $location->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

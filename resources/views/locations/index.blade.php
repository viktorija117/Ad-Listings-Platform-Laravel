<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lokacije') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="alert alert-danger bg-red-700">
                    {{ session('error') }}
                </div>
            @endif
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
                                <li class="flex justify-between items-center">
                                    <span>{{ $location->name }}</span>
                                    <div class="space-x-4">
                                        <!-- Dugme za uređivanje -->
                                        <a href="{{ route('locations.edit', $location) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg shadow-md hover:bg-yellow-700">
                                            Uredi
                                        </a>
                                        <!-- Forma za brisanje lokacije -->
                                        <form action="{{ route('locations.destroy', $location) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700" onclick="return confirm('Da li ste sigurni da želite da obrišete ovu lokaciju?')">
                                                Obriši
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

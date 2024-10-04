<!-- resources/views/locations/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Uredi lokaciju') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('locations.update', $location) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Naziv lokacije</label>
                        <input type="text" name="name" id="name" value="{{ $location->name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <button type="submit" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700">
                        Ažuriraj
                    </button>
                </form>

                <!-- Forma za brisanje lokacije -->
                <form action="{{ route('locations.destroy', $location) }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700" onclick="return confirm('Da li ste sigurni da želite da obrišete ovu lokaciju?')">
                        Obriši lokaciju
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

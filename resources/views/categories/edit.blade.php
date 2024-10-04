<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Uredi kategoriju') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Naziv kategorije -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Naziv</label>
                        <input type="text" name="name" id="name" value="{{ $category->name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Dugme za ažuriranje -->
                    <button type="submit" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700">
                        Ažuriraj
                    </button>
                </form>

                <!-- Forma za brisanje kategorije -->
                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700" onclick="return confirm('Da li ste sigurni da želite da obrišete ovu kategoriju?')">
                        Obriši kategoriju
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

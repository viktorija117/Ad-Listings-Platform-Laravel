<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Dobrodošli, {{ Auth::user()->name }}!</h3>

                <div class="flex flex-col space-y-4">
                    <a href="{{ route('ads.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 text-center">
                        Pregledaj sve oglase
                    </a>
                    <a href="{{ route('ads.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 text-center">
                        Postavi novi oglas
                    </a>
                    <a href="{{ route('my.ads') }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg shadow-md hover:bg-yellow-700 text-center">
                        Moji oglasi
                    </a>
                    <a href="{{ route('messages.inbox') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                        Primljene poruke
                    </a>
                    <a href="{{ route('messages.sent') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                        Poslate poruke
                    </a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 text-center">
                            Upravljaj kategorijama
                        </a>
                        <a href="{{ route('locations.index') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 text-center">
                            Upravljaj lokacijama
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

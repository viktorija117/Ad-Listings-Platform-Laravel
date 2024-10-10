<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <h3 class="text-3xl font-bold text-center text-gray-700 mb-12">Dobrodošli, {{ Auth::user()->name }}!</h3>

            <!-- Grupa za oglase -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-shopping-cart text-current"></i>
                    </div>
                    <h4 class="text-lg font-bold mb-4 text-gray-800">Pregledaj sve oglase</h4>
                    <a href="{{ route('ads.index') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Idi na oglase</a>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                    <div class="text-green-500 mb-4">
                        <i class="fas fa-plus text-current"></i>
                    </div>
                    <h4 class="text-lg font-bold mb-4 text-gray-800">Postavi novi oglas</h4>
                    <a href="{{ route('ads.create') }}" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">Novi oglas</a>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                    <div class="text-yellow-500 mb-4">
                        <i class="fas fa-satellite-dish text-current"></i>
                    </div>
                    <h4 class="text-lg font-bold mb-4 text-gray-800">Moji oglasi</h4>
                    <a href="{{ route('my.ads') }}" class="px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">Prikaži moje oglase</a>
                </div>
            </div>

            <!-- Grupa za poruke -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                    <div class="text-yellow-600 mb-4">
                        <i class="fas fa-comment-dots text-current"></i>
                    </div>
                    <h4 class="text-lg font-bold mb-4 text-gray-800">Kome si slao poruke?</h4>
                    <a href="{{ route('messages.purchases') }}" class="mt-2 inline-block px-4 py-2 bg-yellow-600 text-white rounded-lg shadow-md hover:bg-yellow-700">
                        Pogledaj
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                    <div class="text-yellow-600 mb-4">
                        <i class="fas fa-comment-medical text-current"></i>
                    </div>
                    <h4 class="text-lg font-bold mb-4 text-gray-800">Ko ti je slao poruke?</h4>
                    <a href="{{ route('messages.sales') }}" class="mt-2 inline-block px-4 py-2 bg-yellow-600 text-white rounded-lg shadow-md hover:bg-yellow-700">
                        pogledaj
                    </a>
                </div>
            </div>

            <!-- Grupa za administraciju -->
            @if(auth()->user()->can('manage', App\Models\Category::class) || auth()->user()->can('manage', App\Models\Location::class))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if(auth()->user()->can('manage', App\Models\Category::class))
                        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                            <div class="text-red-500 mb-4">
                                <i class="fa-solid fa-list"></i>
                            </div>
                            <h4 class="text-lg font-bold mb-4 text-gray-800">Upravljaj kategorijama</h4>
                            <a href="{{ route('categories.index') }}" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700">Upravljaj</a>
                        </div>
                    @endif

                    @if(auth()->user()->can('manage', App\Models\Location::class))
                        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                            <div class="text-red-500 mb-4">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <h4 class="text-lg font-bold mb-4 text-gray-800">Upravljaj lokacijama</h4>
                            <a href="{{ route('locations.index') }}" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700">Upravljaj</a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

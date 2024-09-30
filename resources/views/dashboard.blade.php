<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Glavni naslov -->
            <h3 class="text-3xl font-bold text-center text-gray-700 mb-12">Dobrodošli, {{ Auth::user()->name }}!</h3>

            <!-- Grupa za oglase -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                    <div class="text-blue-500 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A2 2 0 013 15.382V6a2 2 0 012-2h6.586a1 1 0 01.707.293l6.414 6.414a1 1 0 01.293.707V18a2 2 0 01-2 2H9z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold mb-4 text-gray-800">Pregledaj sve oglase</h4>
                    <a href="{{ route('ads.index') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Idi na oglase</a>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                    <div class="text-green-500 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold mb-4 text-gray-800">Postavi novi oglas</h4>
                    <a href="{{ route('ads.create') }}" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">Novi oglas</a>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                    <div class="text-yellow-500 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold mb-4 text-gray-800">Moji oglasi</h4>
                    <a href="{{ route('my.ads') }}" class="px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">Prikaži moje oglase</a>
                </div>
            </div>

            <!-- Grupa za poruke -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                    <div class="text-indigo-500 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7 4 7-4v4l-7 4-7-4V8z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold mb-4 text-gray-800">Primljene poruke</h4>
                    <a href="{{ route('messages.inbox') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Pregledaj primljene</a>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                    <div class="text-indigo-500 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4l8 8m0 0l8-8m-8 8V12"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold mb-4 text-gray-800">Poslate poruke</h4>
                    <a href="{{ route('messages.sent') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Pregledaj poslate</a>
                </div>
            </div>

            <!-- Grupa za administraciju -->
            @if(auth()->user()->can('manage', App\Models\Category::class) || auth()->user()->can('manage', App\Models\Location::class))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if(auth()->user()->can('manage', App\Models\Category::class))
                        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                            <div class="text-red-500 mb-4">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10m-6 4h6"></path></svg>
                            </div>
                            <h4 class="text-lg font-bold mb-4 text-gray-800">Upravljaj kategorijama</h4>
                            <a href="{{ route('categories.index') }}" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700">Upravljaj</a>
                        </div>
                    @endif

                    @if(auth()->user()->can('manage', App\Models\Location::class))
                        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center">
                            <div class="text-red-500 mb-4">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c-3.315 0-6 2.685-6 6s2.685 6 6 6 6-2.685 6-6-2.685-6-6-6z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15V9m0 4v4m-6 1l4-4"></path></svg>
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

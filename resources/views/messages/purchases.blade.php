<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Poruke koje ste poslali (Kupovina)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if($chats->isEmpty())
                    <p class="text-gray-600">Niste poslali nijednu poruku za oglase.</p>
                @else
                    @foreach($chats as $chat)
                        <div class="mb-4 p-4 bg-gray-100 rounded-lg shadow-md">
                            <h4 class="text-lg font-bold">Vlasnik oglasa: {{ $chat->receiver->name }}</h4>
                            <p class="text-gray-500 mt-2">Oglas:
                                <a href="{{ route('ads.show', $chat->ad) }}" class="text-blue-600">
                                    {{ $chat->ad->title }}
                                </a>
                            </p>
                            <p><a href="{{ route('messages.chat', $chat->ad) }}" class="text-indigo-600 hover:text-indigo-800">Otvori čet</a></p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

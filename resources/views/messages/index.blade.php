<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Poruke') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if($chats->isEmpty())
                    <p class="text-gray-600">Nemate aktivnih četova.</p>
                @else
                    @foreach($chats as $chat)
                        @php
                            $partner = $chat->sender_id === auth()->id() ? $chat->receiver : $chat->sender;
                            $ad = $chat->ad;
                        @endphp

                        @if(isset($partner) && isset($ad))
                            <div class="mb-4 p-4 bg-gray-100 rounded-lg shadow-md">
                                <h4 class="text-lg font-bold">{{ $ad->title }}</h4>
                                <p class="text-gray-500">Sagovornik: {{ $partner->name }}</p>
                                <a href="{{ route('messages.chat', ['ad' => $ad->id, 'partnerId' => $partner->id]) }}"
                                   class="text-indigo-600 hover:text-indigo-800">Otvori čet</a>
                            </div>
                        @else
                            <p class="text-red-500">Greška: Oglas ili sagovornik nisu dostupni.</p>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

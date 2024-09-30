<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Primljene poruke') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if($messages->isEmpty())
                    <p class="text-gray-600">Nemate primljenih poruka.</p>
                @else
                    @foreach($messages as $message)
                        <div class="mb-4 p-4 bg-gray-100 rounded-lg shadow-md">
                            <h4 class="text-lg font-bold">Od: {{ $message->sender->name }}</h4>
                            <p class="text-gray-600">{{ $message->message }}</p>
                            <p class="text-gray-500 mt-2">Oglas: <a href="{{ route('ads.show', $message->ad) }}" class="text-blue-600">{{ $message->ad->title }}</a></p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

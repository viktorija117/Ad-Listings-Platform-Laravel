<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pošalji poruku prodavcu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Oglas: {{ $ad->title }}</h3>
                <p class="text-gray-600 mb-6">Pošaljite poruku korisniku <strong>{{ $receiver->name }}</strong> u vezi ovog oglasa.</p>

                <form action="{{ route('messages.store', $ad) }}" method="POST" class="space-y-4">
                    @csrf
                    <textarea name="message" class="w-full border border-gray-300 rounded-lg p-2" rows="5" placeholder="Unesite poruku"></textarea>
                    <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Pošalji poruku
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

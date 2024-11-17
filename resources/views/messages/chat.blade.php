<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Čet za oglas: ') }} {{ $ad->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div>
                    @foreach($messages as $message)
                        <div class="mb-4 {{ $message->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                            <p class="p-3 rounded-lg {{ $message->sender_id === auth()->id() ? 'bg-blue-200' : 'bg-gray-200' }}">
                                {{ $message->message }}
                            </p>
                            <small class="text-gray-500">{{ $message->created_at->format('d.m.Y H:i') }}</small>
                        </div>
                    @endforeach
                </div>

                <form method="POST" action="{{ route('messages.store', $ad) }}">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $partner->id }}">
                    <div class="flex items-center mt-4">
                        <textarea name="message" class="w-full p-2 border rounded" rows="3" required></textarea>
                        <button type="submit" class="ml-2 px-4 py-2 bg-indigo-600 text-white rounded">Pošalji</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

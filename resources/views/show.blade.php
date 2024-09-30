<form action="{{ route('messages.store') }}" method="POST">
    @csrf
    <textarea name="message" placeholder="Unesite poruku"></textarea>
    <input type="hidden" name="receiver_id" value="{{ $ad->user->id }}">
    <button type="submit">Pošalji poruku</button>
</form>

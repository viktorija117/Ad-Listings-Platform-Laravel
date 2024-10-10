<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Prikaz svih chatova gde je korisnik učesnik (bilo kao pošiljalac ili primalac)
    public function index()
    {
        $chats = Message::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['ad', 'sender', 'receiver'])
            ->get()
            ->groupBy('ad_id'); // Grupisanje po oglasu

        return view('messages.index', compact('chats'));
    }

    // Prikaz poruka za jedan oglas (chat između dva korisnika)
    public function showChat(Ad $ad)
    {
        // Proveri da li postoje poruke između trenutnog korisnika i vlasnika oglasa za ovaj oglas
        $messages = Message::where('ad_id', $ad->id)
            ->where(function ($query) {
                $query->where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id());
            })
            ->orderBy('created_at', 'asc')
            ->with('sender', 'receiver')
            ->get();

        // Ako ne postoje poruke, vrati korisnika na prethodnu stranicu sa obaveštenjem
        if ($messages->isEmpty()) {
            return redirect()->back()->with('error', 'Čet za ovaj oglas ne postoji, morate prvo poslati poruku preko forme ispod!');
        }

        // Ako poruke postoje, prikaži čet
        return view('messages.chat', compact('ad', 'messages'));
    }


    // Slanje nove poruke
    public function store(Request $request, Ad $ad)
    {
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'ad_id' => $ad->id,
            'message' => $request->message,
        ]);

        return redirect()->route('messages.chat', $ad)->with('success', 'Poruka uspešno poslata.');
    }
}

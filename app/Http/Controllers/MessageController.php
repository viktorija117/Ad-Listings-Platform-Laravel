<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Prikaz forme za slanje poruke
    public function create(Ad $ad)
    {
        $receiver = $ad->user; // Preuzimamo korisnika koji je vlasnik oglasa
        return view('messages.create', compact('ad', 'receiver'));
    }

    // Čuvanje poruke u bazi podataka
    public function store(Request $request, Ad $ad)
    {
        // Validacija podataka
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        // Unos poruke u bazu podataka
        Message::create([
            'sender_id' => auth()->id(), // Trenutno prijavljen korisnik (pošiljalac)
            'receiver_id' => $request->receiver_id, // Primalac poruke
            'ad_id' => $ad->id, // ID oglasa na koji se odnosi poruka
            'message' => $request->message, // Tekst poruke
        ]);

        // Redirekcija nazad na stranicu sa oglasom
        return redirect()->route('ads.show', $ad)->with('success', 'Poruka uspešno poslata.');
    }


    // Prikaz primljenih poruka za prijavljenog korisnika
    public function inbox()
    {
        $messages = Message::where('receiver_id', Auth::id())->with('sender', 'ad')->get();
        return view('messages.inbox', compact('messages'));
    }

    // Prikaz poslatih poruka za prijavljenog korisnika
    public function sent()
    {
        $messages = Message::where('sender_id', Auth::id())->with('receiver', 'ad')->get();
        return view('messages.sent', compact('messages'));
    }
}



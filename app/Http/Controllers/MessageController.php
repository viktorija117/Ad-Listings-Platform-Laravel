<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Prikaz četa vezanog za oglas (ovo ostaje isto)
    public function salesMessages()
    {
        // Oglasi koje je korisnik postavio
        $ads = Ad::where('user_id', auth()->id())->pluck('id');

        // Prikaz jedinstvenih čatova za oglase koje je korisnik postavio
        $chats = Message::whereIn('ad_id', $ads)
            ->select('ad_id', 'sender_id')
            ->distinct()
            ->with('ad', 'sender')
            ->get();

        return view('messages.sales', compact('chats'));
    }

    // Prikaz svih čatova za kupovinu (korisnik je poslao poruku vlasniku oglasa)
    public function purchaseMessages()
    {
        // Prikaz jedinstvenih čatova koje je korisnik inicirao
        $chats = Message::where('sender_id', auth()->id())
            ->select('ad_id', 'receiver_id')
            ->distinct()
            ->with('ad', 'receiver')
            ->get();

        return view('messages.purchases', compact('chats'));
    }

    // Prikaz svih poruka u okviru jednog četa
    public function showChat(Ad $ad)
    {
        // Učitaj sve poruke vezane za oglas između trenutnog korisnika i vlasnika oglasa
        $messages = Message::where('ad_id', $ad->id)
            ->orderBy('created_at', 'asc')
            ->with('sender')
            ->get();

        return view('messages.chat', compact('ad', 'messages'));
    }

    // Čuvanje poruke (ovo ostaje isto)
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



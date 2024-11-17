<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Prikaz svih čatova gde je korisnik učesnik
    public function index()
    {
        $messages = Message::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['ad', 'sender', 'receiver'])
            ->get();

        // Grupisanje poruka po oglasu i sagovorniku
        $chats = $messages->groupBy(function ($message) {
            $partnerId = $message->sender_id === auth()->id() ? $message->receiver_id : $message->sender_id;
            return $message->ad_id . '-' . $partnerId;
        })->map->first();

        return view('messages.index', compact('chats'));
    }

    // Prikaz poruka za jedan čat (jedan oglas + jedan sagovornik)
    public function showChat(Ad $ad, $partnerId)
    {
        $partner = User::find($partnerId);

        if (!$partner) {
            return redirect()->route('messages.index')->with('error', 'Partner ne postoji.');
        }

        $messages = Message::where('ad_id', $ad->id)
            ->where(function ($query) use ($partnerId) {
                $query->where(function ($subQuery) use ($partnerId) {
                    $subQuery->where('sender_id', auth()->id())
                        ->where('receiver_id', $partnerId);
                })->orWhere(function ($subQuery) use ($partnerId) {
                    $subQuery->where('sender_id', $partnerId)
                        ->where('receiver_id', auth()->id());
                });
            })
            ->orderBy('created_at', 'asc')
            ->with(['sender', 'receiver'])
            ->get();

        return view('messages.chat', compact('ad', 'messages', 'partner'));
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

        return redirect()->route('messages.chat', ['ad' => $ad->id, 'partnerId' => $request->receiver_id])
            ->with('success', 'Poruka uspešno poslata.');
    }
}

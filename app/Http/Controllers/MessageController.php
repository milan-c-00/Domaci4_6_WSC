<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function messages(User $user){

        $sent = auth()->user()->sentMessages($user);
        $received = auth()->user()->receivedMessages($user);

        $messages = $sent->merge($received)->sortBy('created_at');

        return view('people.conversation', ['friend' => $user, 'messages' => $messages]);

    }

    public function sendMessage(User $user, StoreMessageRequest $request){

        Message::query()->create($request->validated());

        return redirect()->route('friend.messages', $user->id);

    }

    public function deleteConversation(User $user){

        Message::query()
            ->where('sender_id', auth()->user()->id)
            ->where('receiver_id', $user->id)
            ->orWhere('sender_id', $user->id)
            ->where('receiver_id', auth()->user()->id)
            ->delete();

        return redirect()->route('friend.messages', $user->id);
    }

}

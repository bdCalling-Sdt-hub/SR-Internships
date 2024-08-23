<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ConnectedUser;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function index()
    {
        $connectedUsers = ConnectedUser::with('user')->get();
        $users = User::where("id", "!=", Auth::user()->id)->where("status",1)->get();
        $messages = Message::orderBy('created_at', 'asc')->get();
        return view('backend.layouts.chat.chat', compact('users','connectedUsers', 'messages'));
    }

    public function messageShow(User $user,$id)
    {
        $connectedUsers = ConnectedUser::with('user')->get();
        $messages = Message::orderBy('created_at', 'asc')->get();
        return view('backend.layouts.chat.chat', compact('connectedUsers','messages',));
    }
    public function sendMessage(Request $request)
    {
        // dd($request->all());
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->message,
        ]);

        return response()->json(['message' => 'Message sent successfully!', 'data' => $message]);
    }
}

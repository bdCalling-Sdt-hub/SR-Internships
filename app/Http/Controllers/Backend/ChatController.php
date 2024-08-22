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

    public function sendMessage(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = new Message();
        $message->user_id = Auth::id();
        $message->content = $request->message;
        $message->is_sent = true;
        $message->save();

        return redirect()->route('chat.index');
    }
    // public function sendMessageUser($id)
    // {
    //     dd($id);
    //     // $user= User::where('id', $id)->first();
    //     // $message = Message::where('user_id', $user->id)->get();


    // }
}

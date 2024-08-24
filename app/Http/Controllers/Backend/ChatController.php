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

    public function index(Request $request)
    {
        $users = User::where("status",1)->get();
        $connectedUsers = ConnectedUser::with('user')->get();
        // dd($connectedUsers);
        $messages = Message::orderBy('created_at', 'asc')->get();
        return view('backend.layouts.chat.chat', compact('users','connectedUsers', 'messages'));
    }

    public function messageShow(User $user, $id)
        {
            // Retrieve the current user's ID (the one who is logged in)
            $currentUserId = auth()->id();

            // Fetch all connected users with their associated user details
            $connectedUsers = ConnectedUser::with('user')->get();

            // Fetch messages between the current user and the specific user (with ID $id)
            $messages = Message::where(function ($query) use ($currentUserId, $id) {
                $query->where('sender_id', $currentUserId)
                    ->where('receiver_id', $id);
            })->orWhere(function ($query) use ($currentUserId, $id) {
                $query->where('sender_id', $id)
                    ->where('receiver_id', $currentUserId);
            })->orderBy('created_at', 'asc')->get();

            // dd($messages);

            return view('backend.layouts.chat.chat', compact('connectedUsers', 'messages'));
        }


    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->message,
        ]);

        return response()->json(['message' => 'Message sent successfully!', 'data' => $message]);
    }
    public function uploadImage(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/chat_images'), $imageName);

            // Optionally, save the image path to the database along with the message

            return response()->json([
                'success' => true,
                'imagePath' => asset('uploads/chat_images/' . $imageName),
            ]);
        }

        return response()->json(['success' => false, 'error' => 'Image upload failed']);
    }

}

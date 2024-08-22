<?php

use App\Models\ConnectedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/connected-users', function (Request $request) {
    ConnectedUser::create([
        'user_id' => $request->user_id,
        'socket_id' => $request->socket_id,
    ]);

    return response()->json(['message' => 'User connected'], 201);
});

Route::delete('/connected-users/{socket_id}', function ($socket_id) {
    ConnectedUser::where('socket_id', $socket_id)->delete();

    return response()->json(['message' => 'User disconnected'], 204);
});

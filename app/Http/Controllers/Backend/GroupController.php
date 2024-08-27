<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ConnectedUser;
use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'groupName' => 'required|string|max:255',
            'users' => 'required|array',
            'users.*' => 'exists:users,id'
        ]);

        // Create the group
        $group = new Group();
        $group->name = $validated['groupName'];
        $group->save();

        // Add users to the group
        foreach ($validated['users'] as $userId) {
            GroupMember::create([
                'group_id' => $group->id,
                'user_id' => $userId,
            ]);
        }

        // Fetch group members for response
        $groupMembers = GroupMember::with('user')->where('group_id', $group->id)->get();

        // Prepare response
        $response = [
            'groupName' => $group->name,
            'groupMembers' => $groupMembers->map(function ($groupUser) {
                return [
                    'user_id' => $groupUser->user->id,
                    'user_name' => $groupUser->user->name,
                ];
            })->all(),
            'status' => 'group created successfully!'
        ];

        // Return response
        return response()->json($response);
    }
}

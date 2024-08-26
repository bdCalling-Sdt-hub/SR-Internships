<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate request data
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        // Create the group
        $group = Group::create([
            'name' => 'New Group', // or use $request->input('group_name')
        ]);
        if ($group) {
            $groupMembers =[];
            foreach ($request->input('user_ids') as $user_id) {
               $groupMember= GroupMember::create([
                    'group_id' => $group->id,
                    'user_id' => $user_id,
                ]);
                array_push($groupMembers, $groupMember);
            }
            return response()->json(['status' => 'Group created successfully!','data' => $groupMembers]);
        } else {
            return response()->json(['status' => 'Failed to create group.'], 500);
        }
    }
}

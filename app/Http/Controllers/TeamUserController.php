<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamUserController extends Controller
{
  // public function edit(Team $team)
  public function edit(Team $team)
  {
    $users = User::all();
    $assigned = $team->users()->pluck('id')->toArray();

    return view('teams.users.edit', compact('team', 'users', 'assigned'));
  }

  public function update(Request $request, Team $team)
  {
    $validated = $request->validate([
      'users' => 'array',
      'users.*.role' => 'required|in:owner,member,guest',
      'users.*.assigned' => 'nullable|boolean'
    ]);

    $syncData = [];

    foreach ($validated['users'] as $userId => $data) {
      if (isset($data['assigned'])) {
        $syncData[$userId] = ['role' => $data['role']];
      }
    }

    $team->users()->sync($syncData);

    // $team->users()->sync([
    //     1 => ['role' => 'guest'],
    //     3 => ['role' => 'owner']
    // ]);

    return redirect()->route('teams.users.edit', $team)
      ->with('status', 'Users updated.');
  }
}

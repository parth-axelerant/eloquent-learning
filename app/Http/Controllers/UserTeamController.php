<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class UserTeamController extends Controller
{
  public function edit(User $user)
  {
    $teams = Team::all();
    // echo "!23123";
    // exit;
    $assigned = $user->teams->pluck('id')->toArray();

    return view('users.teams.edit', compact('user', 'teams', 'assigned'));
  }

  public function update(Request $request, User $user)
  {
    $validated = $request->validate([
      'teams' => 'array',
      'teams.*.role' => 'required|in:owner,member,guest',
      'teams.*.assigned' => 'nullable|boolean'
    ]);

    $syncData = [];

    foreach ($validated['teams'] as $userId => $data) {
      if (isset($data['assigned'])) {
        $syncData[$userId] = ['role' => $data['role']];
      }
    }

    $user->teams()->sync($syncData);

    // $team->users()->sync([
    //     1 => ['role' => 'guest'],
    //     3 => ['role' => 'owner']
    // ]);

    return redirect()->route('users.teams.edit', $user)
      ->with('status', 'Users updated.');
  }
}

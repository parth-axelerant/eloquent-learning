<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Profile;
use App\Models\Department;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamUserController;
use App\Http\Controllers\UserTeamController;




Route::get('/', function () {
  return view('welcome');
});

// One to One
Route::get('/onetoone', function () {
  $users = User::with('profile')->get();
  return view('test', [
    'users' => $users,
  ]);
});

Route::get('/onetoone/reverse', function () {
  $profiles = Profile::find(1);
  return view('test', [
    'profiles' => $profiles,
  ]);
});

Route::get('/onetoone/create', function () {
  $user = User::find(1);
  $user->profile()->create([
    'handle' => 'Handle for first user',
    'bio' => 'Bio for first user',
  ]);

  return redirect()->route('onetoone');
});

// One to Many
Route::get('/onetomany', function () {
  $users = User::with(['profile', 'tasks'])->get();

  return view('onetomany', [
    'users' => $users,
  ]);
});

Route::get('/onetomany/list', function () {
  $users = User::with(['profile', 'tasks' => function ($query) {
    $query->where('status', 'H');
  }])->get();

  return view('onetomany-list', [
    'users' => $users,
  ]);
});

// Many to Many
Route::get('/json/', function () {
  $user = User::with('teams')->find(2);
  //$user->teams->makeHidden('pivot'); // to hide the pivot information
  $team = $user->teams->first();
  return [
    'user' => $user->name,
    'first_team' => $team->name,
    'role' => $team->pivot->role,
    'teams_count' => $user->teams_count,
    'is_owner' => $team->pivot->is_owner,
  ];
});


Route::get('/teams', function () {
  return view('teams.index', ['teams' => Team::withCount('users')->get()]);
})->name('teams.index');

Route::get('/users', function () {
  return view('users.index', ['users' => User::withCount('teams')->get()]);
})->name('users.index');

Route::get('/users/{user}/teams', [UserTeamController::class, 'edit'])->name('users.teams.edit');
Route::put('/users/{user}/teams', [UserTeamController::class, 'update'])->name('users.teams.update');

Route::get('/teams/{team}/users', [TeamUserController::class, 'edit'])->name('teams.users.edit');
Route::put('/teams/{team}/users', [TeamUserController::class, 'update'])->name('teams.users.update');


// Has Many Through
Route::get('/departments', function () {
  return view('departments.index', ['departments' => Department::withCount(['users', 'tasks'])->get()]);
})->name('departments.index');

Route::get('/departments-query', function () {
  $departments = Department::first();

  $completed = $departments->tasks()->where('status', 'H')->get();

  return $completed;
});

//Polymorphic relationships are powerful and straightforward once you see the pieces together:
//use morphs in the migration to create the {name}_id and {name}_type columns,
//use morphTo on the polymorphic model (Description, Note), and
//use morphOne or morphMany on the owning models (User, Team, Task).

// Polymorphic Example: One to One
Route::get('/polymorphic', function () {
  return User::with('descriptions')->first()->descriptions->content;
});

// Polymorphic Example: One to Many
Route::get('/polymorphic/notes', function () {
  return User::with('notes')->first()->notes;
});

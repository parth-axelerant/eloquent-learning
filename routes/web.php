<?php

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
  return view('welcome');
});


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

Route::get('/onetomany', function () {
  $users = User::with(['profile', 'tasks'])->get();

  return view('onetomany', [
    'users' => $users,
    // 'tasks' => $tasks,
  ]);
});

Route::get('/onetomany/list', function () {
  $users = User::with(['profile', 'tasks' => function ($query) {
    $query->where('status', 'H');
  }])->get();
  // dump($users);
  // exit;
  return view('onetomany-list', [
    'users' => $users,
    // 'tasks' => $tasks,
  ]);
});

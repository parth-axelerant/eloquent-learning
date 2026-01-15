<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    User::factory(10)->create()->each(function ($user) {
      $user->profile()->create([
        'handle' => "Default Handle for $user->name",
        'bio' => "Default Bio for $user->name",
      ]);
      // $user->tasks()->createMany(Task::factory(10)->make()->toArray());
      $tasks = Task::factory(10)->make()->each(function ($task) use ($user) {
        $task->user_id = $user->id;
      });
      // dump($tasks);
      // exit;
      $user->tasks()->saveMany($tasks);
      // $user->tasks()->saveMany($tasks);
    });

    // User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

  }
}

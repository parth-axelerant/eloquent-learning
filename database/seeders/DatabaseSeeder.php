<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Team;
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
    $teams = Team::factory(5)->create();

    User::factory(10)->create()->each(function ($user) use ($teams) {
      $user->profile()->create([
        'handle' => "Default Handle for $user->name",
        'bio' => "Default Bio for $user->name",
      ]);

      $tasks = Task::factory(10)->make()->each(function ($task) use ($user) {
        $task->user_id = $user->id;
      });

      $user->tasks()->saveMany($tasks);

      // Use 'use ($teams)' in the closure to access $teams variable
      $randomTeams = $teams->random(rand(1, 4));

      foreach (is_iterable($randomTeams) ? $randomTeams : [$randomTeams] as $team) {
        $user->teams()->attach($team->id, ['role' => collect(['member', 'guest', 'owner'])->random()]);
      }
    });
    // User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

  }
}

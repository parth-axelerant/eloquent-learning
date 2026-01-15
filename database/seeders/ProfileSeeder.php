<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfileSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    User::factory(10)->create()->each(function ($user) {
      $user->profile()->create([
        'handle' => "Default Handle for $user->name",
        'bio' => "Default Bio for $user->name",
      ]);
    });
  }
}

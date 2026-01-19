<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Relation::morphMap([
      'User' => User::class,
      'Team' => Team::class,
      'Task' => Task::class,
    ]);

    // Model::preventLazyLoading(); //turns off lazy loading
    Model::automaticallyEagerLoadRelationships(); //loads relationships automatically, sets up at global level loaded safe and efficient level
  }
}

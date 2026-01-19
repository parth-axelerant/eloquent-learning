<?php

namespace App\Models;

use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
  ];

  public function users(): MorphToMany
  {
    return $this->morphedByMany(User::class, 'taggable');
  }

  public function teams(): MorphToMany
  {
    return $this->morphedByMany(Team::class, 'taggable');
  }

  public function tasks(): MorphToMany
  {
    return $this->morphedByMany(Task::class, 'taggable');
  }
}

<?php

namespace App\Models;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use \Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
  /** @use HasFactory<\Database\Factories\DepartmentFactory> */
  use HasFactory;

  protected $fillable = [
    'name',
  ];

  public function users(): HasMany
  {
    return $this->hasMany(User::class);
  }

  public function tasks(): HasManyThrough
  {
    return $this->hasManyThrough(Task::class, User::class);
  }
}

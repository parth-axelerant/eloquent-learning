<?php

namespace App\Models;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
  /** @use HasFactory<\Database\Factories\TeamFactory> */
  use HasFactory;

  protected $fillable = [
    'name',
  ];

  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class)
      ->using(Membership::class)
      ->withPivot('role')
      ->withTimestamps();
  }

  // Replaced with withCount method
  // public function getUsersCountAttribute(): int
  // {
  //   return $this->users->count();
  // }
}

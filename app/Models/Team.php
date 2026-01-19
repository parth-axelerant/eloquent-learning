<?php

namespace App\Models;

use App\Models\Membership;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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

  public function descriptions(): MorphOne
  {
    return $this->morphOne(Description::class, 'describable');
  }

  public function notes(): MorphMany
  {
    return $this->morphMany(Note::class, 'notable'); // notable is the name of the morph field
  }
}

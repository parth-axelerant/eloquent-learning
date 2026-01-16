<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function profile(): HasOne
  {
    return $this->hasOne(Profile::class)->withDefault([
      'handle' => 'Default Handle',
      'bio' => 'Default Bio',
    ]);
  }

  public function tasks(): HasMany
  {
    return $this->hasMany(Task::class);
  }

  public function teams(): BelongsToMany
  {
    return $this->belongsToMany(Team::class)
      ->using(Membership::class)
      ->withPivot('role')
      ->withTimestamps();
  }

  // Accessor, begins with get OR set
  // public function getTeamsCountAttribute(): int
  // {
  //   return $this->teams->count();
  // }
}

<?php

namespace App\Models;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Task extends Model
{
  /** @use HasFactory<\Database\Factories\TaskFactory> */
  use HasFactory;

  protected $fillable = [
    'title',
    'status',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function notes(): MorphMany
  {
    return $this->morphMany(Note::class, 'notable'); // notable is the name of the morph field
  }
  public function tags(): MorphToMany
  {
    return $this->morphToMany(Tag::class, 'taggable');
  }
}

<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Note extends Model
{
  protected $fillable = [
    'content',
  ];

  public function notable(): MorphTo
  {
    return $this->morphTo(User::class);
  }
}

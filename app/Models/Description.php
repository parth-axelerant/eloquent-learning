<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Description extends Model
{
  protected $fillable = [
    'content',
  ];

  public function describable(): MorphTo
  {
    return $this->morphTo(User::class);
  }
}

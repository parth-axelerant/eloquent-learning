<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Membership extends Pivot
{

  protected $casts = [
    'role' => 'string',
  ];

  public function getIsOwnerAttribute(): bool
  {
    return $this->role === 'owner';
  }
}

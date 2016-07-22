<?php

namespace App\Models;

use App\Models\Map;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * Get person's map.
   * A person should've been in one place at any given time.
   */
  public function location()
  {
    return $this->morphMany(Location::class, 'locatable')->first();
  }
}

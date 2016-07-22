<?php

namespace App\Models;

use App\Models\Map;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
	/**
	 * Get ad's map.
	 */
	public function locations()
	{
		return $this->morphMany(Location::class, 'locatable');
	}

	/**
	 * Get owning user
	 * 
	 * @return App\Models\User
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

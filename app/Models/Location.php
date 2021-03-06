<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
	use App\Lib\Traits\MySQLNearbyQueryBuilder;

class Location extends Model
{
	use MySQLNearbyQueryBuilder;

	// default radius (in metric)
	const KM = 6371;
	const MILE = 3959;

	const DEFAULT_RADIUS = 1; // 1 KM or 1 MILE

	/**
	 * Get all of the owning mappable models.
	 */
	public function locatable()
	{
		return $this->morphTo();
	}

	static function nearby($lat, $lng, $rad = null)
	{
		if(!$rad){
			$rad = self::DEFAULT_RADIUS;
		}
		
		$static = new static;

		$nearbyQuery = $static->buildNearbyQuery($static->getTable(), self::KM, $lat, $lng, $rad);

		return $nearbyQuery->get();
	}
}

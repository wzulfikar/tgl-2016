<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
	use App\Lib\Traits\MySQLNearbyQueryBuilder;

class Mappable extends Model
{
	use MySQLNearbyQueryBuilder;

	// default radius (in metric)
	const DEFAULT_RADIUS = 500;
	const KM = 6371;
	const MILE = 3959;

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

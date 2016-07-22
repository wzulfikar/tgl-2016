<?php 

namespace App\Lib\Traits;

use App\Models\Location;
use Illuminate\Support\Facades\DB;

trait MySQLNearbyQueryBuilder {
  public function buildNearbyQuery($tbl, $measurement_unit, $lat, $lng, $rad)
  {
    // https://developers.google.com/maps/articles/phpsqlsearch_v3#findnearsql
    return Location::with('locatable')
                    ->select(DB::raw(
                    'id, lat, lng, locatable_id, locatable_type, 
                    ROUND(' . $measurement_unit . ' * acos ( cos ( radians(' . $lat . ') )
                      * cos( radians( lat ) )
                      * cos( radians( lng ) - radians(' . $lng . ') )
                      + sin ( radians('  . $lat . ') )
                      * sin( radians( lat ) )
                    ), 2) AS distance'))
                   ->having('distance', '<=', $rad)
                   ->orderBy('distance');
  }
}
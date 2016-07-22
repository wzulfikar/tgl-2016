<?php 

namespace App\Lib\Traits;

use Illuminate\Support\Facades\DB;

trait MySQLNearbyQueryBuilder {
  public function buildNearbyQuery($tbl, $rad_unit, $lat, $lng, $rad)
  {
    return DB::table($tbl)
             ->select(DB::raw(
              '*, ' . $rad_unit . ' * acos (
                cos ( radians(78.3232) )
                * cos( radians( lat ) )
                * cos( radians( lng ) - radians(65.3234) )
                + sin ( radians(78.3232) )
                * sin( radians( lat ) )
              ) AS distance'))
             ->having('distance', '<=', $rad)
             ->orderBy('distance');
  }
}
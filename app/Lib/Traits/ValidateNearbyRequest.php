<?php 

namespace App\Lib\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait ValidateNearbyRequest {
  public function validateNearbyRequest(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'lat'  => 'required',
      'lng' => 'required',
      'rad' => 'sometimes|numeric',
    ]);

    if ($validator->fails()) {
      return ['err' => $validator->messages()->toArray()];
    }
  }
}
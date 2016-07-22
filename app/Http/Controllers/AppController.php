<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Lib\Traits\ValidateNearbyRequest;

class AppController extends Controller
{
	use ValidateNearbyRequest;

	public function getNearby(Request $request)
	{
		$validate = $this->validateNearbyRequest($request);
		if(isset($validate['err'])){
			return Response::json($validate['err'], 400);
		}

		return Location::nearby($request->lat, $request->lng, $request->rad);
	}
}

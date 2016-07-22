<?php

namespace App\Http\Controllers;

use App\Models\Mappable;
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

		return Mappable::nearby($request->lat, $request->long, $request->dist);
	}
}

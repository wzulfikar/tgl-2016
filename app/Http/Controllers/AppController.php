<?php

namespace App\Http\Controllers;

use Socialite;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Lib\Traits\SocialiteHelper;
use Illuminate\Support\Facades\Response;
use App\Lib\Traits\ValidateNearbyRequest;

class AppController extends Controller
{
	use ValidateNearbyRequest, SocialiteHelper;

	public function getNearby(Request $request)
	{
		$validate = $this->validateNearbyRequest($request);
		if(isset($validate['err'])){
			return Response::json($validate['err'], 400);
		}

		return Location::nearby($request->lat, $request->lng, $request->rad);
	}

	public function redirect()
	{
    return Socialite::driver('facebook')->redirect();
	}

	public function callback(Request $request, $provider)
	{
		$providerUser = Socialite::driver($provider)->user();

		$user = $this->findOrCreateProviderUser(Socialite::driver('facebook')->user());

		auth()->login($user);

		return redirect()->to('/home');
	}
}

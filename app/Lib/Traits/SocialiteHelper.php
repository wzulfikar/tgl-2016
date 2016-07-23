<?php 

namespace App\Lib\Traits;

use App\Models\User;

trait SocialiteHelper {
	public function createUserFromProvider($providerUser)
	{
		$user = new User;
		$user->fb_id  = $providerUser->getId();
		$user->email  = $providerUser->getEmail();
		$user->name   = $providerUser->getName();
		$user->avatar = $providerUser->getAvatar();
		
		if($user->save()){
			return $user;
		}

		return false;
	}

	public function findOrCreateProviderUser($providerUser){
    $user = User::where('email', $providerUser->getEmail())
								->first();

    if (!$user) {
	    $user = $this->createUserFromProvider($providerUser);
    }

    return $user;
  }
}
<?php

use App\Models\Ad;
use App\Models\User;
use App\Models\Location;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Faker\Generator $faker) {
  return [
    'name' => $faker->name,
    'email' => $faker->safeEmail,
    'password' => bcrypt(str_random(10)),
    'remember_token' => str_random(10),
  ];
});

$factory->define(Ad::class, function (Faker\Generator $faker) {
  return [
    'title' => $faker->catchPhrase,
    'desc'  => sprintf('RM %s', $faker->numberBetween(400, 600)),
  ];
});

$factory->defineAs(Location::class, 'usm-nearby', function (Faker\Generator $faker) {

	$ad = factory(Ad::class)->create();

  return [
  	// lat & lng for area around USM
		'lat' => $faker->latitude(5.3, 5.4),			
		'lng' => $faker->longitude(100.2, 100.3),
		'locatable_id' => $ad->id,
		'locatable_type' => get_class($ad)
  ];
});



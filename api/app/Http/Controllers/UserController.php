<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\WeatherService;

class UserController extends Controller
{

	protected $weatherService;

	public function __construct(WeatherService $weatherService)
	{
		$this->weatherService = $weatherService;
	}


	public function userWeathers()
	{
		$users = User::all();
		$userWeather = [];

		foreach ($users as $user) {
			$weather = $this->weatherService->getCurrentWeather($user->latitude, $user->longitude);
			$userWeather[] = [
				'user' => $user,
				'weather' => $weather,
			];
		}

		return response()->json(['users' => $userWeather]);
	}
}

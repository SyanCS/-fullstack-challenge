<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHER_API_KEY');
    }

    public function getCurrentWeather(float $lat, float $lon)
    {
			$cacheKey = "weather_{$lat}_{$lon}";
			$cacheExpiration = now()->addHours(1);

			return Cache::remember($cacheKey, $cacheExpiration, function () use ($lat, $lon) {
					$response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
							'lat' => $lat,
							'lon' => $lon,
							'appid' => $this->apiKey,
							'units' => 'metric',
					]);

					if ($response->ok()) {
							return $response->json();
					}

					return null;
			});
    }
}

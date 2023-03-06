<?php

use App\Services\WeatherService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CachingTest extends TestCase
{
    use RefreshDatabase;


    public function testCachingFunctionality()
		{
			$lat = 43.6532;
			$lon = -79.3832;

			// Create a mock response
			$mockResponse = ['mock' => 'data'];

			// Mock the HTTP client
			$mockClient = Http::fake([
					"https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid=" . env('OPENWEATHER_API_KEY') . "&units=metric" => Http::response($mockResponse),
			]);

			// Create a new instance of the WeatherService
			$weatherService = new WeatherService();

			// Verify that the cache is initially empty
			$this->assertFalse(Cache::has("weather_{$lat}_{$lon}"));

			// Get the current weather for the specified latitude and longitude
			$weatherData = $weatherService->getCurrentWeather($lat, $lon);

			// Verify that the mock data was returned
			$this->assertEquals($mockResponse, $weatherData);

			// Verify that the weather data was stored in the cache
			$this->assertTrue(Cache::has("weather_{$lat}_{$lon}"));

			// Retrieve the weather data from the cache
			$cachedWeatherData = Cache::get("weather_{$lat}_{$lon}");

			// Verify that the cached weather data matches the original weather data
			$this->assertEquals($weatherData, $cachedWeatherData);

			// Clear the cache
			Cache::forget("weather_{$lat}_{$lon}");

			// Verify that the cache is now empty
			$this->assertFalse(Cache::has("weather_{$lat}_{$lon}"));

			// Get the current weather for the specified latitude and longitude again
			$weatherData2 = $weatherService->getCurrentWeather($lat, $lon);

			// Verify that the mock data was returned
			$this->assertEquals($mockResponse, $weatherData2);

			// Verify that the weather data was stored in the cache again
			$this->assertTrue(Cache::has("weather_{$lat}_{$lon}"));

			// Retrieve the weather data from the cache again
			$cachedWeatherData2 = Cache::get("weather_{$lat}_{$lon}");

			// Verify that the cached weather data matches the original weather data again
			$this->assertEquals($weatherData2, $cachedWeatherData2);
	}

}

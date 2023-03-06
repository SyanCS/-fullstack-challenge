<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class UserTest extends TestCase
{
	use RefreshDatabase;

	public function testGetUsersWeatherEndpoint()
	{
			$response = $this->get('/userWeathers');
			$response->assertOk();
			$response->assertJsonStructure([
					'users' => [
							'*' => [
									'user' => [
											'id',
											'name',
											'email',
											'email_verified_at',
											'latitude',
											'longitude',
											'created_at',
											'updated_at'
									],
									'weather' => [
											'coord',
											'weather',
											'base',
											'main',
											'visibility',
											'wind',
											'clouds',
											'dt',
											'sys',
											'timezone',
											'id',
											'name',
											'cod'
									]
							]
					]
			]);
	}
}

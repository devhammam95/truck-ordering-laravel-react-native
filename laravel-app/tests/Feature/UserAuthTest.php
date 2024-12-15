<?php

namespace Tests\Feature;

use Faker\Generator;
use Illuminate\Container\Container;
use Tests\TestCase;
use Users\Models\User;

class UserAuthTest extends TestCase
{
    private $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Container::getInstance()->make(Generator::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_login()
    {
        $email = $this->faker->unique()->safeEmail();
        User::factory()->create([
            'email' => $email,
        ]);

        $response = $this->post(
            '/api/v1/user/login',
            [
                'email' => $email,
                'password' => 'password',
            ]
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }

    public function test_user_logout()
    {
        $email = $this->faker->unique()->safeEmail();
        User::factory()->create([
            'email' => $email,
        ]);

        $response = $this->post(
            '/api/v1/user/login',
            [
                'email' => $email,
                'password' => 'password',
            ]
        );

        $response = $this->post(
            '/api/v1/user/logout',
            [],
            [
                'Authorization' => "Bearer {$response['token']}",
            ]
        );

        $response->assertStatus(200);
    }
}

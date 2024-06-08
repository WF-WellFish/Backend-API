<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Test user can register
     *
     * @return void
     */
    public function test_register_new_user(): void
    {
        $userFactory = User::factory()->make([
            'username' => 'test_user'
        ])->toArray();

        $response = $this->postJson(route('register'), array_merge($userFactory, ['password' => 'password']))
        ->assertStatus(201)
        ->assertJson([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => []
        ]);

        $this->assertDatabaseHas('users', $userFactory);
    }

    /**
     * Test user cannot register with invalid data
     *
     * @return void
     */
    public function test_register_with_invalid_data(): void
    {
        $response = $this->postJson(route('register'), [])
        ->assertStatus(422)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'errors' => [
                    'name',
                    'username',
                    'password'
                ]
            ]
        ]);

        $this->assertDatabaseCount('users', 0);
    }

    /**
     * Test user cannot register with existing username
     *
     * @return void
     */
    public function test_register_with_existing_username(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('register'), $user->toArray())
        ->assertStatus(422)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'errors' => [
                    'username'
                ]
            ]
        ]);

        $this->assertDatabaseCount('users', 1);
    }

    /**
     * Test user cannot register with invalid username
     *
     * @return void
     */
    public function test_register_with_invalid_username(): void
    {
        $userFactory = User::factory()->make([
            'username' => 'test user'
        ])->toArray();

        $response = $this->postJson(route('register'), array_merge($userFactory, ['password' => 'password']))
        ->assertStatus(422)
        ->assertJson([
            "status" => "error",
            "message" => "Request validation failed.",
            "data" => [
                "errors" => [
                    "username" => [
                        "The username must only contain letters, numbers, underscores, and dashes."
                    ]
                ]
            ]
        ]);

        $this->assertDatabaseCount('users', 0);
    }

    /**
     * Test user cannot register with invalid password
     *
     * @return void
     */
    public function test_register_with_invalid_password(): void
    {
        $userFactory = User::factory()->make([
            'username' => 'test_user'
        ])->toArray();

        $response = $this->postJson(route('register'), array_merge($userFactory, ['password' => 'pass']))
        ->assertStatus(422)
        ->assertJson([
            "status" => "error",
            "message" => "Request validation failed.",
            "data" => [
                "errors" => [
                    "password" => [
                        "The password field must be at least 8 characters."
                    ]
                ]
            ]
        ]);

        $this->assertDatabaseCount('users', 0);
    }
}

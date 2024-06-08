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
        $userFactory = User::factory()->make()->toArray();

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
}

<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Test user can log in with valid credentials.
     *
     * @return void
     */
    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'username' => 'admin',
            'password' => bcrypt('password')
        ]);

        $response = $this->postJson(route('login'), [
            'username' => $user->username,
            'password' => 'password'
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'user',
                    'token'
                ]
            ]);

        $this->assertAuthenticated();

        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'tokenable_type' => 'App\Models\User'
        ]);
    }

    /**
     * Test user cannot log in with invalid credentials.
     *
     * @return void
     */
    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        $user = User::factory()->create([
            'username' => 'admin',
            'password' => bcrypt('password')
        ]);

        $response = $this->postJson(route('login'), [
            'username' => $user->username,
            'password' => 'wrong-password'
        ])
            ->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Username or password is incorrect',
                'data' => []
            ])
            ->assertJsonStructure([
                'status',
                'message',
                'data'
            ]);

        $this->assertGuest();

        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'tokenable_type' => 'App\Models\User'
        ]);
    }

    /**
     * Test login request validation.
     *
     * @return void
     */
    public function test_login_request_validation(): void
    {
        $response = $this->postJson(route('login'), []);

        $response->assertStatus(422)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'errors' => [
                    'username',
                    'password'
                ]
            ],
        ]);

        $this->assertEquals('The username field is required.', $response['data']['errors']['username'][0]);
        $this->assertEquals('The password field is required.', $response['data']['errors']['password'][0]);
    }
}

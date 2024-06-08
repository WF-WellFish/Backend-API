<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    /**
     * Test Authenticated User With Valid Data Can Change Password
     *
     * @return void
     */
    public function test_authenticated_user_with_valid_data_can_change_password(): void
    {
        $user = $this->createUser();

        $this->actingAs($user);

        $response = $this->postJson(route('change-password'), [
            'old_password' => 'password',
            'new_password' => 'new_password',
            'new_password_confirmation' => 'new_password',
        ])
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Change password success.',
                'data' => [],
            ]);
    }

    /**
     * Test Authenticated User With Invalid Old Password Cannot Change Password
     *
     * @return void
     */
    public function test_authenticated_user_with_invalid_old_password_cannot_change_password(): void
    {
        $user = $this->createUser();

        $this->actingAs($user);

        $response = $this->postJson(route('change-password'), [
            'old_password' => 'invalid_password',
            'new_password' => 'new_password',
            'new_password_confirmation' => 'new_password',
        ])
            ->assertJson([
                'status' => 'error',
                'message' => 'Request validation failed.',
                'data' => [
                    'errors' => [
                        'old_password' => ['The password is incorrect.'],
                    ],
                ],
            ]);
    }

    /**
     * Test Authenticated User With Invalid New Password Cannot Change Password
     *
     * @return void
     */
    public function test_authenticated_user_with_invalid_new_password_cannot_change_password(): void
    {
        $user = $this->createUser();

        $this->actingAs($user);

        $response = $this->postJson(route('change-password'), [
            'old_password' => 'password',
            'new_password' => 'new',
            'new_password_confirmation' => 'new',
        ])
            ->assertJson([
                'status' => 'error',
                'message' => 'Request validation failed.',
                'data' => [
                    'errors' => [
                        "new_password" => [
                            "The new password field must be at least 8 characters."
                        ],
                        "new_password_confirmation" =>  [
                            "The new password confirmation field must be at least 8 characters."
                        ],
                    ],
                ],
            ]);
    }

    /**
     * Test Unauthenticated User Cannot Change Password
     *
     * @return void
     */
    public function test_unauthenticated_user_cannot_change_password(): void
    {
        $response = $this->postJson(route('change-password', 1), [
            'old_password' => 'password',
            'new_password' => 'new_password',
            'new_password_confirmation' => 'new_password',
        ])
            ->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Unauthenticated.',
                'data' => [],
            ]);
    }
}

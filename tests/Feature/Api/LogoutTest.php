<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * Test Auth user can log out and token is removed from database.
     *
     * @return void
     */
    public function test_auth_user_can_logout(): void
    {
        $user = $this->createUser();
        $this->actingAs($user);

        $response = $this->getJson(route('logout'))
            ->assertStatus(200);

        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'tokenable_type' => get_class($user)
        ]);
    }

    /**
     * Test Unauthenticated user can not access the log out route
     *
     * @return void
     */
    public function test_guest_can_not_access_logout(): void
    {
        $this->getJson(route('logout'))
            ->assertStatus(401);
    }
}

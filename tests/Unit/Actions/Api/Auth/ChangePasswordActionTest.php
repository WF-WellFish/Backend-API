<?php

namespace Actions\Api\Auth;

use App\Actions\Api\Auth\ChangePasswordAction;
use Tests\TestCase;

class ChangePasswordActionTest extends TestCase
{
    /**
     * Test action change password working well.
     *
     * @return void
     */
    public function test_action_class_working_well(): void
    {
        $user = $this->createUser();

        $this->actingAs($user);

        ChangePasswordAction::run([
            'new_password' => 'new_password'
        ]);

        $this->assertTrue(
            password_verify('new_password', $user->fresh()->password)
        );

        $this->assertFalse(
            password_verify('password', $user->fresh()->password)
        );
    }
}

<?php

namespace Tests\Unit\Actions\Api\Auth;

use App\Actions\Api\Auth\RegisterAction;
use App\Models\User;
use Tests\TestCase;

class RegisterActionTest extends TestCase
{
    /**
     * Test if action register is working
     *
     * @return void
     */
    public function test_register_action(): void
    {
        $data = User::factory()->make()->toArray();
        $data['password'] = 'password';

        RegisterAction::run($data);

        unset($data['password']);
        $this->assertDatabaseHas('users', $data);
    }
}

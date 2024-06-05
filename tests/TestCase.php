<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * Helper function to create a user
     *
     * @param array $customField
     * @return User
     */
    public function createUser(array $customField = []): User
    {
        return User::factory()->create($customField);
    }
}

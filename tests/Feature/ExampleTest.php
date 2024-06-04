<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Database\Factories\UserFactory;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_created_from_factory(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', ['username' => $user->username]);
    }
}

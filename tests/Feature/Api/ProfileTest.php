<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * Test the profile update endpoint
     *
     * @return void
     */
    public function test_success_update(): void
    {
        // Create a user
        $user = $this->createUser();

        // Authenticate the user
        $this->actingAs($user);

        // Create a fake storage disk for testing
        Storage::fake('public');

        // Send a PUT request to the profile update endpoint
        $response = $this->putJson(route('profile.update', $user->id), [
            'name' => 'John Doe',
            'profile_picture' => UploadedFile::fake()->image('profile.jpg')
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'user' => [
                        'id',
                        'name',
                        'profile_picture',
                    ]
                ]
            ]);

        // Assert the profile picture exists in the storage
        Storage::disk('public')->assertExists('profile_pictures/' . $response['data']['user']['profile_picture']);

        // Assert the user is updated in the database
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => $user->name
        ]);

        // Assert the user is updated in the database
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'John Doe',
            'profile_picture' => $response['data']['user']['profile_picture']
        ]);
    }

    /**
     * Test the profile update endpoint with invalid data
     *
     * @return void
     */
    public function test_fail_update(): void
    {
        // Create a user
        $user = $this->createUser();

        // Authenticate the user
        $this->actingAs($user);

        // Send a PUT request to the profile update endpoint
        $this->putJson(route('profile.update', $user->id), [
            'name' => '',
            'profile_picture' => 'invalid-image'
        ])
            ->assertStatus(422)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'errors' => [
                        'name',
                        'profile_picture'
                    ]
                ]
            ]);

        // Assert the user is not updated in the database
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name,
            'profile_picture' => $user->profile_picture
        ]);

        // Assert the profile picture does not exist in the storage
        Storage::disk('public')->assertMissing('profile_pictures/invalid-image');
    }
}

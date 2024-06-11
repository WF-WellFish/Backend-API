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
        $oldUser = $user->toArray();

        // Authenticate the user
        $this->actingAs($user);

        // Create a fake storage disk for testing
        Storage::fake('gcs-public');

        // Send a PUT request to the profile update endpoint
        $response = $this->putJson(route('profile.update'), [
            'name' => 'John Doe 123',
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

        $filename = explode('/', $response['data']['user']['profile_picture'])[4];

        // Assert that the profile picture has been uploaded
        Storage::disk('gcs-public')->assertExists('/profile-pictures/' . $filename);

        // Assert the user is updated in the database
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => $oldUser['name'],
        ]);
        // Assert the user is updated in the database
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'John Doe 123',
            'profile_picture' => $filename,
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

        // Create a fake storage disk for testing
        Storage::fake('gcs-public');

        // Send a PUT request to the profile update endpoint
        $this->putJson(route('profile.update'), [
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
        Storage::disk('gcs-public')->assertMissing('/profile-pictures/invalid-image');
    }
}

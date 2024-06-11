<?php

namespace Tests\Unit\Actions\Api\Profile;

use App\Actions\Api\Profile\UpdateProfileAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateProfileActionTest extends TestCase
{
    /**
     * Test that the update profile action works as expected
     *
     * @return void
     */
    public function test_update_profile_action(): void
    {
        $user = $this->createUser([
            'name' => 'fake name'
        ]);
        $this->actingAs($user);

        $oldUser = $user->toArray();

        Storage::fake();

        $updatedUser = UpdateProfileAction::run([
            'name' => 'John Doe',
            'profile_picture' => UploadedFile::fake()->image('profile.jpg')
        ]);

        // Assert that the profile picture has been uploaded
        Storage::assertExists('/' . $updatedUser->profile_picture);

        // Assert that the user has been updated
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $updatedUser->name,
            'profile_picture' => $updatedUser->profile_picture
        ]);

        // Assert that the old user data is not in the database
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => $oldUser['name']
        ]);
    }
}

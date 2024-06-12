<?php

namespace Tests\Unit\Actions\Api\MachineLearning;

use App\Actions\Api\MachineLearning\ClassificationAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ClassificationActionTest extends TestCase
{
    /**
     * Test classification action class works correctly.
     *
     * @return void
     */
    public function test_classification_action_class_works_correctly(): void
    {
        $user  = $this->createUser();
        $this->actingAs($user);

        Storage::fake('gcs-public');

        $response = ClassificationAction::run([
            'image' => UploadedFile::fake()->image('fish.jpg'),
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('type', $response);
        $this->assertArrayHasKey('description', $response);
        $this->assertArrayHasKey('food', $response);
        $this->assertArrayHasKey('food_shop', $response);
        $this->assertArrayHasKey('picture', $response);

        $fileName = explode('classification-histories/', $response['picture'])[1];

        $this->assertDatabaseHas('classification_histories', [
            'user_id' => $user->id,
            'picture' => $fileName,
            'name' => $response['name'],
            'type' => $response['type'],
            'description' => $response['description'],
            'food' => $response['food'],
            'food_shop' => $response['food_shop'],
        ]);

        Storage::disk('gcs-public')->assertExists('classification-histories/' . $fileName);
    }
}

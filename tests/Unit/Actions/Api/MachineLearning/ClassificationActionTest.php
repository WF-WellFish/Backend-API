<?php

namespace Tests\Unit\Actions\Api\MachineLearning;

use App\Actions\Api\MachineLearning\ClassificationAction;
use Database\Seeders\FishSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ClassificationActionTest extends TestCase
{
    /**
     * Set up the test
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('gcs-public');
        Http::fake([
            config('machine-learning.api_url').'/classify' => Http::response([
                'data' => [
                    'index' => 1,
                ],
            ]),
        ]);

        $this->seed([
            FishSeeder::class,
        ]);
    }

    /**
     * Test classification action class works correctly.
     *
     * @return void
     */
    public function test_classification_action_class_works_correctly(): void
    {
        $user = $this->createUser();
        $this->actingAs($user);

        $response = ClassificationAction::run([
            'image' => UploadedFile::fake()->image('fish.jpg'),
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('type', $response);
        $this->assertArrayHasKey('description', $response);
        $this->assertArrayHasKey('food', $response);

        $this->assertDatabaseHas('classification_histories', [
            'user_id' => $user->id,
        ]);
    }
}

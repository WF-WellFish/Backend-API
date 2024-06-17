<?php

namespace Tests\Feature\Api;

use Database\Seeders\FishSeeder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ClassificationTest extends TestCase
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

        $this->seed([
            FishSeeder::class,
        ]);
    }

    /**
     * Fake a successful HTTP request
     *
     * @return void
     */
    private function successHttpFake(): void
    {
        Http::fake([
            config('machine-learning.api_url').'/classify' => Http::response([
                'data' => [
                    'index' => 1,
                ],
            ]),
        ]);
    }

    /**
     * Fake a failed HTTP request
     *
     * @return void
     */
    public function failedHttpFake(): void
    {
        Http::fake([
            config('machine-learning.api_url').'/classify' => Http::response([], 500),
        ]);
    }

    /**
     * Test auth user can classify image and save to database and upload file to bucket
     *
     * @return void
     */
    public function test_auth_user_can_classify_image_and_save_to_database(): void
    {
        $this->successHttpFake();
        $user = $this->createUser();

        $this->actingAs($user);

        $response = $this->postJson(route('classification'), [
            'image' => UploadedFile::fake()->image('fish.jpg')
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'type',
                    'description',
                    'food',
                ],
            ]);

        $this->assertDatabaseCount('classification_histories', 1);

        $this->assertDatabaseHas('classification_histories', [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test guest user can classify image and not save to database and not upload file to bucket
     *
     * @return void
     */
    public function test_guest_user_can_classify_image_and_not_save_to_database(): void
    {
        $this->successHttpFake();

        $response = $this->postJson(route('classification'), [
            'image' => UploadedFile::fake()->image('fish.jpg')
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'type',
                    'description',
                    'food',
                ],
            ]);

        $this->assertDatabaseCount('classification_histories', 0);
    }

    /**
     * Test validation request
     *
     * @return void
     */
    public function test_validation_request(): void
    {
        $user = $this->createUser();

        $this->actingAs($user);

        $this->postJson(route('classification'), [])
            ->assertStatus(422)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'errors' => [
                        'image',
                    ],
                ],
            ]);

        $this->assertDatabaseCount('classification_histories', 0);
    }

    /**
     * test exception will be thrown if response api failed
     *
     * @return void
     */
    public function test_exception_will_be_thrown_if_response_api_failed(): void
    {
        $this->failedHttpFake();
        $user = $this->createUser();

        $this->actingAs($user);

        $this->postJson(route('classification'), [
            'image' => UploadedFile::fake()->image('fish.jpg')
        ])
            ->assertStatus(500)
            ->assertJson([
                'status' => 'error',
                'message' => 'Failed to classify image.',
                'data' => []
            ]);

        $this->assertDatabaseCount('classification_histories', 0);
    }


    /**
     * test connection exception will be thrown if failed to call machine learning API
     *
     * @return void
     */
    public function test_connection_exception_will_be_thrown_if_failed_to_call_machine_learning_api(): void
    {
        Exceptions::fake();
        Http::fake([
            config('machine-learning.api_url').'/classify' => function () {
                throw new ConnectionException('Failed to connect to the machine learning API.');
            },
        ]);

        $user = $this->createUser();

        $this->actingAs($user);

        $this->postJson(route('classification'), [
            'image' => UploadedFile::fake()->image('fish.jpg')
        ])
            ->assertStatus(500)
            ->assertJson([
                'status' => 'error',
                'message' => 'Failed to connect to the machine learning API.',
                'data' => []
            ]);

        Exceptions::assertReported(ConnectionException::class);

        Exceptions::assertReported(function (ConnectionException $e) {
            return $e->getMessage() === 'Failed to connect to the machine learning API.';
        });
    }
}

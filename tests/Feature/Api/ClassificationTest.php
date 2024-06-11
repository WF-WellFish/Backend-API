<?php

namespace Tests\Feature\Api;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ClassificationTest extends TestCase
{
    /**
     * Test user can classify image.
     *
     * @return void
     */
    public function test_user_can_classify_image(): void
    {
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
                    'food_shop',
                ],
            ]);

        $this->assertDatabaseCount('classification_histories', 1);

        $this->assertDatabaseHas('classification_histories', [
            'user_id' => $user->id,
            'fish_name' => $response['data']['name'],
            'fish_type' => $response['data']['type'],
            'fish_description' => $response['data']['description'],
            'fish_food' => $response['data']['food'],
            'fish_food_shop' => $response['data']['food_shop'],
        ]);
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
     * Test user can't classify image if not authenticated.
     *
     * @return void
     */
    public function test_user_cant_classify_image_if_not_authenticated(): void
    {
        $this->postJson(route('classification'), [
            'image' => UploadedFile::fake()->image('fish.jpg')
        ])
            ->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Unauthenticated.',
                'data' => []
            ]);

        $this->assertDatabaseCount('classification_histories', 0);
    }
}

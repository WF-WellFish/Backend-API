<?php

namespace Tests\Feature\Api;

use App\Models\ClassificationHistory;
use Tests\TestCase;

class ClassificationHistoryTest extends TestCase
{
    /**
     * Test get user classification history.
     *
     * @return void
     */
    public function test_get_classification_history(): void
    {
        $this->withoutExceptionHandling();
        $user = $this->createUser();
        $this->actingAs($user);

        ClassificationHistory::factory()->count(5)->create([
            'user_id' => $user->id
        ]);

        $response = $this->getJson(route('classification.history'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'picture',
                        'created_at'
                    ]
                ]
            ]);

        $this->assertCount(5, $response->json('data'));
    }

    /**
     * Test user can't get classification history when not authenticated.
     *
     * @return void
     */
    public function test_user_cant_get_classification_history_when_not_authenticated(): void
    {
        $this->withoutExceptionHandling();
        $this->getJson(route('classification.history'))
            ->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Unauthenticated.',
                'data' => []
            ]);
    }

    /**
     * Test maximum history classification is 15.
     *
     * @return void
     */
    public function test_maximum_history_classification(): void
    {
        $this->withoutExceptionHandling();


        $user = $this->createUser();
        $this->actingAs($user);

        ClassificationHistory::factory()->count(20)->create([
            'user_id' => $user->id
        ]);

        $response = $this->getJson(route('classification.history'));

        $this->assertCount(15, $response->json('data'));
    }

    /**
     * Test get fish classification detail by id.
     *
     * @return void
     */
    public function test_get_fish_classification_detail_by_id(): void
    {
        $this->withoutExceptionHandling();

        $user = $this->createUser();
        $this->actingAs($user);

        $classification = ClassificationHistory::factory()->create([
            'user_id' => $user->id,
            'picture' => 'classification.jpg'
        ]);

        $response = $this->getJson(route('classification.show', $classification->id))
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
                    'picture'
                ]
            ]);

        $this->assertEquals($classification->name, $response->json('data.name'));
        $this->assertEquals($classification->type, $response->json('data.type'));
        $this->assertEquals($classification->description, $response->json('data.description'));
        $this->assertEquals($classification->food, $response->json('data.food'));
        $this->assertEquals($classification->food_shop, $response->json('data.food_shop'));
        $this->assertEquals($classification->picture_url, $response->json('data.picture'));
    }

    /**
     * Test user can't get fish classification detail by id when not authenticated.
     *
     * @return void
     */
    public function test_user_cant_get_fish_classification_detail_by_id_when_not_authenticated(): void
    {
        $user = $this->createUser();
        $classification = ClassificationHistory::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->getJson(route('classification.show', $classification->id))
            ->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Unauthenticated.',
                'data' => []
            ]);
    }
}

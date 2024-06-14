<?php

namespace Tests\Feature\Api;

use App\Models\ClassificationHistory;
use Database\Seeders\FishSeeder;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ClassificationHistoryTest extends TestCase
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
     * Test get user classification history.
     *
     * @return void
     */
    public function test_get_classification_history(): void
    {
        $user = $this->createUser();
        $this->actingAs($user);

        ClassificationHistory::factory()->count(5)->create([
            'user_id' => $user->id,
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
        $user = $this->createUser();
        $this->actingAs($user);

        ClassificationHistory::factory()->count(20)->create([
            'user_id' => $user->id,
            'fish_id' => 1,
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
        $user = $this->createUser();
        $this->actingAs($user);

        $classification = ClassificationHistory::factory()->create([
            'user_id' => $user->id,
            'picture' => 'classification.jpg',
            'fish_id' => 1,
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
                    'picture'
                ]
            ]);

        $this->assertEquals($classification->fish->name, $response->json('data.name'));
        $this->assertEquals($classification->fish->type, $response->json('data.type'));
        $this->assertEquals($classification->fish->description, $response->json('data.description'));
        $this->assertEquals($classification->fish->food, $response->json('data.food'));
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

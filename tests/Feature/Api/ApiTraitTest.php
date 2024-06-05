<?php

namespace Tests\Feature\Api;

use App\Traits\ApiTrait;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class ApiTraitTest extends TestCase
{
    use ApiTrait;

    /**
     * Test the structure of the success response.
     *
     * @return void
     */
    public function test_success_response_structure(): void
    {
        $response = $this->success(['test' => 'data'], 'Success Response Message', 200);

        $this->assertObjectHasProperty('status', $response->getData());
        $this->assertObjectHasProperty('message', $response->getData());
        $this->assertObjectHasProperty('data', $response->getData());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals('success', $response->getData()->status);
        $this->assertEquals('Success Response Message', $response->getData()->message);
        $this->assertEquals(['test' => 'data'], (array) $response->getData()->data);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test the structure of the error response.
     *
     * @return void
     */
    public function test_error_response_structure(): void
    {
        $response = $this->error(['data' => 'error'], 'Error message', 400);

        $this->assertObjectHasProperty('status', $response->getData());
        $this->assertObjectHasProperty('message', $response->getData());
        $this->assertObjectHasProperty('data', $response->getData());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals('error', $response->getData()->status);
        $this->assertEquals('Error message', $response->getData()->message);
        $this->assertEquals(['data' => 'error'], (array) $response->getData()->data);
        $this->assertEquals(400, $response->getStatusCode());
    }
}

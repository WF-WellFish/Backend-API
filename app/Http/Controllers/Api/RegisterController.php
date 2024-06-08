<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\Auth\RegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * Register a new user
     *
     * @param RegisterRequest $request
     * @param RegisterAction $action
     * @return JsonResponse
     */
    public function index(RegisterRequest $request, RegisterAction $action): JsonResponse
    {
        $action->run($request->validated());

        return $this->success([], 'User registered successfully', 201);
    }
}

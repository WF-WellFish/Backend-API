<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function index(RegisterRequest $request): JsonResponse
    {

    }
}

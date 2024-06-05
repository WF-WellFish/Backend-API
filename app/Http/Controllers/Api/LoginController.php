<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming login request.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function index(LoginRequest $request): JsonResponse
    {
        if(!Auth::attempt($request->validated())) {
            return $this->error([], 'Username or password is incorrect', 401);
        }

        $user = Auth::user();

        $user->tokens()->delete();

        return $this->success([
            'user' => new UserResource(Auth::user()),
            'token' => Auth::user()->createToken('authToken')->plainTextToken,
        ], 'Login successful', 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Logout user (Revoke the token)
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return $this->success([], 'Logged out successfully');
    }
}

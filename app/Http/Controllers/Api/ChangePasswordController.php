<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\Auth\ChangePasswordAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangePasswordRequest;
use Illuminate\Http\JsonResponse;

class ChangePasswordController extends Controller
{
    /**
     * Change password
     *
     * @param ChangePasswordRequest $request
     * @param ChangePasswordAction $action
     * @return JsonResponse
     */
    public function index(ChangePasswordRequest $request, ChangePasswordAction $action): JsonResponse
    {
        $action->run($request->validated());

        return $this->success([], 'Change password success.', 200);
    }
}

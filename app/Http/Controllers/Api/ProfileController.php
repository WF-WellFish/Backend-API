<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\Profile\UpdateProfileAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    /**
     * Update user profile information.
     *
     * @param UpdateProfileRequest $request
     * @param User $user
     * @param UpdateProfileAction $action
     * @return JsonResponse
     */
    public function update(UpdateProfileRequest $request, User $user, UpdateProfileAction $action): JsonResponse
    {
        $user = $action->run($user, $request->validated());

        return $this->success([
            'user' => new UserResource($user)
        ], 'Profile updated successfully.', 200);
    }
}

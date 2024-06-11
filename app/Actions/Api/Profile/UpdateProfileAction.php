<?php

namespace App\Actions\Api\Profile;

use App\Actions\Action;
use App\Models\User;
use App\Services\UploadImageService;
use Illuminate\Support\Facades\Auth;

class UpdateProfileAction extends Action
{
    /**
     * Update user profile information.
     *
     * @param array $data
     * @return User
     */
    public function handle(array $data): User
    {
        if($data['profile_picture'] ?? false) {
            $data['profile_picture'] = app(UploadImageService::class)->uploadImagePublic($data['profile_picture'], 'profile-pictures');
        }

        $user = Auth::user();
        return tap($user)->update($data);
    }
}

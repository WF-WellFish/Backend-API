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
        $user = Auth::user();
        if($data['profile_picture'] ?? false) {
            $profilePicture = app(UploadImageService::class)->uploadImagePublic($data['profile_picture'], 'profile-pictures');
        }

        $data['profile_picture'] = $profilePicture['file_name'] ?? $user->profile_picture;
        return tap($user)->update($data);
    }
}

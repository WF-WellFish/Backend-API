<?php

namespace App\Actions\Api\Profile;

use App\Actions\Action;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateProfileAction extends Action
{
    /**
     * Update user profile information.
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function handle(User $user, array $data): User
    {
        if($data['profile_picture'] ?? false) {
            $data['profile_picture'] = $this->uploadImage($data['profile_picture']);
        }

        return tap($user)->update($data);
    }

    /**
     * Upload image to storage and return the file name.
     *
     * @param UploadedFile $image
     * @return string
     */
    private function uploadImage(UploadedFile $image): string
    {
        $originalName = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $now = Carbon::now();
        $fileName = md5($originalName . $now . Str::random(8)) . '.' . $extension;

        // TODO: Upload image to google cloud storage
        Storage::disk('public')->putFileAs('profile_pictures', $image, $fileName);

        return $fileName;
    }
}

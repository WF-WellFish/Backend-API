<?php

namespace App\Actions\Api\Profile;

use App\Actions\Action;
use App\Models\User;
use Carbon\Carbon;
use http\Exception\RuntimeException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\UnableToSetVisibility;
use League\Flysystem\UnableToWriteFile;

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
            $data['profile_picture'] = $this->uploadImage($data['profile_picture']);
        }
        $user = Auth::user();
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
        try {
            $originalName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $now = Carbon::now();
            $fileName = md5($originalName . $now . Str::random(8)) . '.' . $extension;

            Storage::putFileAs('', $image, $fileName);
        } catch(UnableToWriteFile|UnableToSetVisibility $e) {
            throw new RuntimeException('Failed to upload image.');
        }

        return $fileName;
    }
}

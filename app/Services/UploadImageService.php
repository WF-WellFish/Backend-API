<?php

namespace App\Services;

use Carbon\Carbon;
use http\Exception\RuntimeException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\UnableToSetVisibility;
use League\Flysystem\UnableToWriteFile;

class UploadImageService
{
    /**
     * Upload image to google cloud storage bucket and return the file name.
     *
     * @param UploadedFile $image
     * @param string $path
     * @param string $disk
     * @return string
     */
    public function uploadImage(UploadedFile $image, string $path = '', string $disk = 'gcs'): string
    {
        try {
            $originalName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $now = Carbon::now();
            $fileName = md5($originalName . $now . Str::random(8)) . '.' . $extension;

            Storage::disk($disk)->putFileAs($path, $image, $fileName);
        } catch(UnableToWriteFile|UnableToSetVisibility $e) {
            throw new RuntimeException('Failed to upload image.');
        }

        return $fileName;
    }

    /**
     * Upload image to google cloud storage public bucket and return the file name.
     *
     * @param UploadedFile $image
     * @param string $path
     * @return string
     */
    public function uploadImagePublic(UploadedFile $image, string $path = ''): string
    {
        return $this->uploadImage($image, $path, 'gcs-public');
    }
}

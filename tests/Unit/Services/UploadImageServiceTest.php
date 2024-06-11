<?php

namespace Tests\Unit\Services;

use App\Services\UploadImageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadImageServiceTest extends TestCase
{
    /**
     * Test upload image service can upload image to storage and return the file name.
     *
     * @return void
     */
    public function test_upload_image_service(): void
    {
        Storage::fake('gcs');

        $service = new UploadImageService();

        $image = UploadedFile::fake()->image('image.jpg');

        $fileName = $service->uploadImage($image);

        Storage::disk('gcs')->assertExists('/' . $fileName);

        $this->assertIsString($fileName);
    }

    /**
     * Test upload image service can upload image to public storage and return the file name.
     *
     * @return void
     */
    public function test_upload_image_public_service(): void
    {
        Storage::fake('gcs-public');

        $service = new UploadImageService();

        $image = UploadedFile::fake()->image('image.jpg');

        $fileName = $service->uploadImagePublic($image, 'profile-pictures');

        Storage::disk('gcs-public')->assertExists('/profile-pictures/' . $fileName);

        $this->assertIsString($fileName);
    }
}

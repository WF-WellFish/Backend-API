<?php

namespace App\Actions\Api\MachineLearning;

use App\Actions\Action;
use App\Models\ClassificationHistory;
use App\Services\UploadImageService;
use Illuminate\Support\Facades\Auth;

class ClassificationAction extends Action
{
    // Todo: implement the actual machine learning API call
    /**
     * Classify user image and store the result in the database.
     * Call the machine learning API to classify the image.
     *
     * @param array $data
     * @return array
     */
    public function handle(array $data): array
    {
        //        try {
        //        $response = Http::post('http://localhost:5000/classification', [
        //            'image' => $request->image
        //        ]);
        //        } Catch(\Exception $e) {
        //            return $e->getMessage();
        //        }
        //

        // temporary result only for testing, replace with the actual result from the machine learning API
        $image = app(UploadImageService::class)->uploadImagePublic($data['image'], 'classification-histories');

        $result =  array_merge([
            'user_id' => Auth::user()->id,
            'picture' => $image['file_name'],
        ], $this->randomResult());

        ClassificationHistory::query()->create($result);

        $result['picture'] = $image['url'];

        return $result;
    }

    private function randomResult(): array
    {
        return [
            'name' => 'fish name ' . $this->randomNumber(),
            'type' => 'fish type ' . $this->randomNumber(),
            'description' => 'fish description ' . $this->randomNumber(),
            'food' => 'fish food ' . $this->randomNumber(),
            'food_shop' => 'fish food shop ' . $this->randomNumber(),
        ];
    }

    private function randomNumber(): int
    {
        return rand(1, 100);
    }
}

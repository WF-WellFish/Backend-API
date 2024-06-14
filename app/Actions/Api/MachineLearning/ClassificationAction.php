<?php

namespace App\Actions\Api\MachineLearning;

use App\Actions\Action;
use App\Models\ClassificationHistory;
use App\Models\Fish;
use App\Services\UploadImageService;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class ClassificationAction extends Action
{
    /**
     * Classify user image and store the result in the database.
     * Call the machine learning API to classify the image.
     *
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function handle(array $data): array
    {
        $response = $this->classifyImage($data['image']);

        $image = $this->uploadImage($data['image']);

        $fish = $this->getFish($response['data']['index']);

        $history = $this->createHistory($fish->id, $image['file_name']);

        return $this->prepareResponse($history, $fish);
    }

    /**
     * Classify the image using machine learning API.
     *
     * @param $image
     * @return Response
     * @throws Exception
     */
    protected function classifyImage($image): Response
    {
        try {
            $filename = $image->getClientOriginalName();
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'WF-Auth' => config('machine-learning.api_key')
            ])
                ->attach('image', file_get_contents($image), $filename)
                ->post(config('machine-learning.api_url').'/classify');
        } catch (Exception $e) {
            throw new ConnectionException('Failed to connect to the machine learning API.');
        }

        if ($response->failed()) {
            throw new Exception('Failed to classify image.');
        }

        return $response;
    }

    /**
     * Upload the image.
     *
     * @param $image
     * @return array
     */
    protected function uploadImage($image): array
    {
        return app(UploadImageService::class)->uploadImagePublic($image, 'classification-histories');
    }

    /**
     * Get the fish data.
     *
     * @param $id
     * @return Fish
     */
    protected function getFish($id): Fish
    {
        return Fish::query()->where('id', $id)->first();
    }

    /**
     * Create a new history record.
     *
     * @param $fishId
     * @param $fileName
     * @return ClassificationHistory
     */
    protected function createHistory($fishId, $fileName): ClassificationHistory
    {
        return ClassificationHistory::query()->create([
            'user_id' => Auth::user()->id,
            'fish_id' => $fishId,
            'picture' => $fileName,
        ]);
    }

    /**
     * Prepare the response data.
     *
     * @param ClassificationHistory $history
     * @param Fish $fish
     * @return array
     */
    protected function prepareResponse(ClassificationHistory $history, Fish $fish): array
    {
        return [
            'id' => $history->id,
            'name' => $fish->name,
            'type' => $fish->type,
            'description' => $fish->description,
            'food' => $fish->food,
            'picture' => $history->picture_url,
        ];
    }
}

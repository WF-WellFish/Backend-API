<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\MachineLearning\ClassificationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClassificationRequest;
use Illuminate\Http\JsonResponse;

class ClassificationController extends Controller
{
    /**
     * Classify fish image using machine learning.
     *
     * @param ClassificationRequest $request
     * @param ClassificationAction $action
     * @return JsonResponse
     */
    public function index(ClassificationRequest $request, ClassificationAction $action): JsonResponse
    {
        $classified = $action->run($request->validated());

        return $this->success([
            'name' => $classified['fish_name'],
            'type' => $classified['fish_type'],
            'description' => $classified['fish_description'],
            'food' => $classified['fish_food'],
            'food_shop' => $classified['fish_food_shop'],
        ], 'Image has been classified.', 200);
    }
}

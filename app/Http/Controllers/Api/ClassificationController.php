<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\MachineLearning\ClassificationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClassificationRequest;
use App\Models\ClassificationHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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
            'name' => $classified['name'],
            'type' => $classified['type'],
            'description' => $classified['description'],
            'food' => $classified['food'],
            'food_shop' => $classified['food_shop'],
            'picture' => $classified['picture']
        ], 'Image has been classified.', 200);
    }

    /**
     * Show fish classification by id.
     *
     * @param int $id
     * @param ClassificationAction $action
     * @return JsonResponse
     */
    public function show(int $id, ClassificationAction $action): JsonResponse
    {
        return $this->success([], 'Fish classification by id.', 200);
    }

    /**
     * Show fish classification history.
     *
     * @param ClassificationAction $action
     * @return JsonResponse
     */
    public function history(ClassificationAction $action): JsonResponse
    {
        //        $classifications = ClassificationHistory::query()->where('user_id', Auth::id())->get([
        //            'id',
        //            'fish_name',
        //            'image_url',
        //            'created_at'
        //        ]);
        return $this->success([], 'Fish classification history.', 200);
    }
}

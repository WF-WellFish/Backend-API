<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\MachineLearning\ClassificationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClassificationRequest;
use App\Http\Resources\ClassificationHistoryResource;
use App\Models\ClassificationHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

        return $this->success($classified, 'Image has been classified.', 200);
    }

    /**
     * Show fish classification by id.
     *
     * @param ClassificationHistory $history
     * @param Request $request
     * @return JsonResponse
     */
    public function show(ClassificationHistory $history, Request $request): JsonResponse
    {
        $resourceData = (new ClassificationHistoryResource($history))->toArray($request);

        return $this->success($resourceData, 'Fish classification by id.', 200);
    }

    /**
     * Show fish classification history.
     *
     * @return JsonResponse
     */
    public function history(): JsonResponse
    {
        $classifications = ClassificationHistory::query()
            ->with(['fish'])
            ->where('user_id', Auth::id())
            ->latest()
            ->take(15)
            ->get([
                'id',
                'fish_id',
                'picture',
                'created_at'
            ])
            ->map(function (ClassificationHistory $classification) {
                return [
                    'id' => $classification->id,
                    'name' => $classification->fish->name,
                    'picture' => $classification->picture_url,
                    'created_at' => $classification->created_at->diffForHumans()
                ];
            });

        return $this->success($classifications->toArray(), 'Fish classification history.', 200);
    }
}

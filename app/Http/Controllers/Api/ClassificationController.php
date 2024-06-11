<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\MachineLearning\ClassificationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClassificationRequest;
use Illuminate\Http\JsonResponse;

class ClassificationController extends Controller
{
    public function index(ClassificationRequest $request, ClassificationAction $action): JsonResponse
    {
        $response = $action->run($request->validated());

        return $this->success([], 'Image has been classified.', 200);
    }
}

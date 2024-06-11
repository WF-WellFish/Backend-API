<?php

namespace App\Actions\Api\MachineLearning;

use App\Actions\Action;
use App\Models\ClassificationHistory;

class ClassificationAction extends Action
{
    public function handle(array $data): string
    {
        //        try {
        //        $response = Http::post('http://localhost:5000/classification', [
        //            'image' => $request->image
        //        ]);
        //        } Catch(\Exception $e) {
        //            return $e->getMessage();
        //        }
        //
        //        ClassificationHistory::query()->create([
        //            'user_id',
        //            'fish_name',
        //            'fish_type',
        //            'fish_description',
        //            'fish_food',
        //            'fish_food_stall',
        //        ]);

        return 'Image has been classified.';
    }
}

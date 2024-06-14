<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassificationHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->fish->name,
            'type' => $this->fish->type,
            'description' => $this->fish->description,
            'food' => $this->fish->food,
            'picture' => $this->picture_url
        ];
    }
}

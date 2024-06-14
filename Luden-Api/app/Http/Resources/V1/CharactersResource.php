<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CharactersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'visibility' => $this->visibility ? 'public' : 'private',
            'description' => $this->description,
            'birth_date' => Carbon::parse($this->birth_date)->format('m/d/Y H:i:s'),
            'image_url' => $this->image_url,
            'status' => $this->status,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name
            ],
            'skills' => $this->skill->map(function ($skill) {
                return [
                    'id' => $skill->id,
                    'name' => $skill->name,
                    'value' => $skill->pivot->value
                ];
            }),
        ];
    }

}

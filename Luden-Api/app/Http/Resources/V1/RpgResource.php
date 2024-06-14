<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RpgResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'rpg_date' => Carbon::parse($this->rpg_date)->format('m/d/Y H:i:s'),
            'rpg_system' => [
                'id' => $this->rpgSystem->id,
                'name' => $this->rpgSystem->name
            ],
            'master' => [
                'id' => $this->master->id,
                'name' => $this->master->name
            ],
        ];
    }
}

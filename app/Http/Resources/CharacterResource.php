<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'gender' => $this->gender,
            'race' => $this->race,
            'description' => $this->description,
            'image' => new ImageResource($this->image),
            'birth_location' => new LocationResource($this->birth_location),
            'current_location' => new LocationResource($this->current_location),
        ];
    }
}

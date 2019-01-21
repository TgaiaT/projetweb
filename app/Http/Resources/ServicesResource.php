<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
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
			'subname' => $this->subname,
			'description' => $this->description,
			'price' => $this->price,
			'disponibility' => $this->disponibility,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			];
    }
}

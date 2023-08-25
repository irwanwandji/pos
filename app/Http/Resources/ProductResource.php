<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => CategoryResource::make($this->category),
            'price' => $this->price,
            'sku' => $this->sku,
            'image' => url('storage/' . $this->image),
            'status' => $this->status,
            'description' => $this->description,
        ];
    }
}

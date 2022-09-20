<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResourse extends JsonResource
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
            'img' => $this->img,
            'prize' => $this->prize,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'categories' => $this->categories()->get(),
        ];
    }
}

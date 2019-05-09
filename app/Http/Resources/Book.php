<?php

namespace App\Http\Resources;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'data' => parent::toArray($request),
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}

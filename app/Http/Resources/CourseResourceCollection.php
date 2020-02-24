<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseResourceCollection extends ResourceCollection
{
    protected $user;

    public function getUser($value)
    {
        $this->user = $value;
        return $this;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (CourseResource $resource) use ($request) {
            return $resource->getUser($this->user)->toArray($request);
        })->all();
    }
}

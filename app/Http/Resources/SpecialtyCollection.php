<?php

namespace App\Http\Resources;

use App\Specialty;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SpecialtyCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Specialty $specialty) {
            return (new SpecialtyResource($specialty))->additional($this->additional);
        });

        return parent::toArray($request);
    }
}

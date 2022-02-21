<?php

namespace App\Http\Resources;

use App\Address;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AddressCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Address $address) {
            return (new AddressResource($address))->additional($this->additional);
        });

        return parent::toArray($request);
    }
}

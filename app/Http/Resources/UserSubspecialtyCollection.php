<?php

namespace App\Http\Resources;

use App\UserSubspecialty;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserSubspecialtyCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (UserSubspecialty $user_subspecialty) {
            return (new UserSubspecialtyResource($user_subspecialty))->additional($this->additional);
        });

        return parent::toArray($request);
    }
}

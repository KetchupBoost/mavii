<?php

namespace App\Http\Resources;

use App\Event;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Event $event) {
            return (new EventResource($event))->additional($this->additional);
        });

        return parent::toArray($request);
    }
}

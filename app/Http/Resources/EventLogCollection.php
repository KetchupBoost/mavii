<?php

namespace App\Http\Resources;

use App\EventLog;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventLogCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (EventLog $event_log) {
            return (new EventLogResource($event_log))->additional($this->additional);
        });

        return parent::toArray($request);
    }
}

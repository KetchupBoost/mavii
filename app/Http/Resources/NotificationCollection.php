<?php

namespace App\Http\Resources;

use App\Notification;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Notification $notification) {
            return (new NotificationResource($notification))->additional($this->additional);
        });

        return parent::toArray($request);
    }
}

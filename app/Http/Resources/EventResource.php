<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'start_hour' => $this->start_hour,
            'professional_start_hour' => $this->professional_start_hour,
            'professional_end_hour' => $this->professional_end_hour,
            'people_amount' => $this->people_amount,
            'people_amount_description' => \App\Enums\EventPeopleAmount::getDescription($this->people_amount),
            'location' => $this->location,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'price' => $this->price,
            'status' => $this->status,
            'event_category' => $this->event_category,
            'user' => $this->user,
            'professional' => $this->professional,
            'event_applications' => $this->event_applications,
            'event_application' => $this->event_application,
            'event_logs' => $this->event_logs
        ];
    }
}

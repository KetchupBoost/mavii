<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AddressResource;
use App\Http\Resources\UserSubspecialtyCollection;

class UserResource extends JsonResource
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
            'diplay_name' => $this->diplay_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cellphone' => $this->cellphone,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'type' => $this->type,
            'cpf' => $this->cpf,
            'cnpj' => $this->cnpj,
            'company_name' => $this->company_name,
            'bio' => $this->bio,
            'status' => $this->status,
            'avatar' => $this->avatar,
            'slug' => $this->slug,
            'role' => $this->role,
            'address' => new AddressResource($this->address),
            'user_subspecialties' => new UserSubspecialtyCollection($this->user_subspecialties)
        ];
    }
}

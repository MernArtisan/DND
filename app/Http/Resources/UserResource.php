<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'phone_code' => $this->phone_code,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
            'email_verified_at' => $this->email_verified_at,
            'gender' => $this->gender,
            'address' => $this->address,
            'image' => $this->image,
            'last_login_at' => $this->last_login_at,
        ];
    }
}

<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data): User
    {
        return User::create([
            'name' => $data['fullname'],
            'email' => $data['email'],
            'phone' => $data['phonecode'] . $data['phone'],
            'phone_code' => $data['phonecode'],
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'address' => $data['address'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);
    }
}

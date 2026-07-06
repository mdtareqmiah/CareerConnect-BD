<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): User
    {
        return DB::transaction(function () use ($data) {

            $user = User::create([

                'role_id' => $data['role_id'],

                'name' => $data['name'],

                'email' => $data['email'],

                'phone' => $data['phone'],

                'password' => Hash::make($data['password'])

            ]);

            UserProfile::create([

                'user_id' => $user->id

            ]);

            return $user;
        });
    }
}
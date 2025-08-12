<?php

namespace App\Services;

use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function updateUser(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function updatePassword(string $new_password): User
    {
        $user = request()->user();
        $user->password = $new_password;
        $user->save();
        return $user;
    }

    public function destroyUser(User $user): User
    {
        $user->delete();
        return $user;
    }
}

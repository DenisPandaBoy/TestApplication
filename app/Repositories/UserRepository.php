<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    public function getUsers(): Collection
    {
        return User::all();
    }

    public function getUserById(int $id): User
    {
        return User::findOrFail($id);
    }
}

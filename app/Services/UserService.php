<?php

namespace App\Services;

use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;

class UserService
{
   public function updatePassword(string $new_password): User
   {
       $user = request()->user();
       $user->password = $new_password;
       $user->save();
       return $user;
   }
}

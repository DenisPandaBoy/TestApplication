<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;

class AuthController
{
    public function updatePassword(UpdatePasswordRequest $request)
    {
        if($request->new_password != $request->reenteredPassword) return "Passwords do not match";

        $user = request()->user();
        $user->password = bcrypt($request->new_password);
        $user->save();
        return "Password updated successfully";
    }
}

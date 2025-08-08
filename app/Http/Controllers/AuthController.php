<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Services\UserService;

class AuthController extends APIController
{
    public function __construct(
      private readonly UserService $userService
    ) {}
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $validated = $request->validated();

        $this->userService->updatePassword(bcrypt($validated['new_password']));

        return $this->responseJson(message:"Password changed successfully.");
    }
}

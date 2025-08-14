<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends APIController
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserService             $userService
    )
    {
    }

    public function index(): JsonResponse
    {
        $users = $this->userRepository->getUsers();

        $resource = UserResource::collection($users);
        return $this->responseJson(data: $resource);
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userRepository->getUserById($id);

        $resource = UserResource::make($user);
        return $this->responseJson(data: $resource);
    }

    public function store(CreateuserRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->all());

        $resource = UserResource::make($user);
        return $this->responseJson(data: $resource);
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = $this->userRepository->getUserById($id);

        $updatedUser = $this->userService->updateUser($user, $request->all());

        $resource = UserResource::make($updatedUser);
        return $this->responseJson(data: $resource);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = $this->userRepository->getUserById($id);

        $this->userService->destroyUser($user);

        return $this->responseJson(message: "User $user->name deleted.");
    }
}

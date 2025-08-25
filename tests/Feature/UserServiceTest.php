<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_createUser_function(): void
    {
        $user = User::factory()->make()->toArray();
        $user['password'] = fake()->password;

        $service = new UserService();
        $service->createUser($user);

        unset($user['password'], $user['email_verified_at']);

        $this->assertDatabaseHas('users', $user);
    }

    public function test_updateUser_function(): void
    {
        $user = User::factory()->create();
        $data = User::factory()->make()->toArray();

        $service = new UserService();
        $service->updateUser($user, $data);

        $this->assertDatabaseHas('users', array_merge( $data, ['id' => $user->id]));
    }

    public function test_deleteUser_function(): void
    {
        $user = User::factory()->create();

        $service = new UserService();
        $service->destroyUser($user);

        $this->assertDatabaseMissing('users', $user->toArray());
    }
}

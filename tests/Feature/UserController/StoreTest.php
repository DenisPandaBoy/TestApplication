<?php

namespace tests\Feature\UserController;

use App\Models\User;
use Tests\TestCase;

class StoreTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_store_successfully(): void
    {
        $user = User::factory()->create();
        $data = $this->getUserData();

        $response = $this->actingAs($user)->post('api/users', $data);

        $response->assertSuccessful();
    }

    public function test_user_store_password_validation(): void
    {
        $user = User::factory()->create();
        $data = $this->getUserData();
        $data['password'] = 'somethingelse';

        $response = $this->actingAs($user)->post('api/users', $data);

        $response->assertRedirect();
    }

    public function test_user_store_data_incomplete(): void
    {
        $user = User::factory()->create();
        $data = $this->getUserData();
        unset($data['email']);

        $response = $this->actingAs($user)->post('api/users', $data);

        $response->assertRedirect();
    }

    private function getUserData(): array{
        $password = fake()->password(8);
        return [
            'name' => fake()->name,
            'last_name' => fake()->lastName,
            'email' => fake()->email,
            'password' => $password,
            'password_confirmation' => $password,
        ];
    }
}

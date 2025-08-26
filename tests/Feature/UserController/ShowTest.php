<?php

namespace tests\Feature\UserController;

use App\Models\User;
use Tests\TestCase;

class ShowTest extends TestCase
{
    /**
     * A basic feature test example.
     */


    public function test_get_concrete_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/users/'.$user->id);

        $response->assertStatus(200);
    }

    public function test_user_not_found(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/users/0');

        $response->assertNotFound();
    }
}

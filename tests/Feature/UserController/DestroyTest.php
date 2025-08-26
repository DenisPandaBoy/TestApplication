<?php

namespace tests\Feature\UserController;

use App\Models\User;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_delete_user(): void
    {
        $user = User::factory()->create();
        $user1 = User::factory()->create();

        $response = $this->actingAs($user)->delete('api/users/'.$user1->id);

        $response->assertStatus(200);
    }
}

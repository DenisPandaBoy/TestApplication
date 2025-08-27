<?php

namespace tests\Feature\UserController;

use App\Models\User;
use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_get_all_users(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('api/users');

        $response->assertStatus(200);
    }
}

<?php

namespace tests\Feature\UserController;

use App\Models\User;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_update_user(): void
    {
        $user = User::factory()->create();

        $data = [
            'name' => 'testof',
            'last_name' => 'testersky',
            'email' => 'testovic@email.com',
        ];
        $response = $this->actingAs($user)->patch('api/users/'.$user->id,$data);

        $response->assertSuccessful();
    }

    public function test_update_user_not_found(): void
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'testof',
            'last_name' => 'testersky',
            'email' => 'testovic@email.com',
        ];
        $response = $this->actingAs($user)->patch('api/users/0',$data);

        $response->assertNotFound();
    }
}

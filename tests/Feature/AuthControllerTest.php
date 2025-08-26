<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_updatePassword_request(): void
    {
        $user = User::factory()->create(['password' => bcrypt('test')]);

        $response = $this->actingAs($user)->post('api/user/update-password', [
            'old_password' => 'test',
            'new_password' => 'newPasswordTest',
            'new_password_confirmation' => 'newPasswordTest',
        ]);

        $response->dump();
        $response->assertStatus(200);
    }

    public function test_userCanGetInfo_request(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/user');

        $response->assertStatus(200);
    }
}

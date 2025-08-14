<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(User::where('email','test@example.com')->get()->isEmpty()){
            User::factory()
                ->has(Order::factory()->count(2))
                ->create([
                'name' => 'Test User',
                'last_name' => 'Testovic',
                'email' => 'test@example.com',
                'password' => bcrypt('test'),
            ]);
        }
    }
}

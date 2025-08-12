<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if(User::where('email','test@example.com')->get()->isEmpty()){
            User::factory()->create([
                'name' => 'Test User',
                'last_name' => 'Testovic',
                'email' => 'test@example.com',
                'password' => bcrypt('test'),
            ]);
        }

        $this->call([
            OrderSeeder::class,
            CategorySeeder::class,
        ]);

    }
}

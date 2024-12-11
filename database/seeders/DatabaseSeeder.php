<?php

namespace Database\Seeders;

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

        $this->call(RoleSeeder::class);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
       
        $user = User::factory()->create([
            'name' => 'Victor Daniel Archundia Sanchez',
            'email' => 'varchundia.yei10@gmail.com',
            'password' => bcrypt('Yeiglo20'),
        ]);
        $user->assignRole('Admin');
        User::factory(20)->create();
    }
}

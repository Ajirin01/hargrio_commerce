<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Olagoke',
            'last_name' => 'Mubarak',
            'email' => 'mubarakolagoke@gmail.com',
            'password' => bcrypt('Ajirin01'),
            'role' => 'customer',
        ]);

        User::factory()->create([
            'first_name' => 'Ishola',
            'last_name' => 'Ajirin',
            'email' => 'isholaajirin01@gmail.com',
            'password' => bcrypt('Ajirin01'),
            'role' => 'admin'
        ]);

        $this->call([
            ProductCategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}

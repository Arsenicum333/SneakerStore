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
        if (!User::query()->exists()) {
            User::factory()->create([
                'first_name' => 'Test',
                'last_name' => 'Admin',
                'email' => 'test@example.com',
                'is_admin' => true,
            ]);
        }

        $this->call(ProductCatalogSeeder::class);
    }
}

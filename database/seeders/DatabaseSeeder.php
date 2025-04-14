<?php

namespace Database\Seeders;

use App\Models\Position;
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
        $this->createAdministrator();
    }

    /**
     * @return void
     */
    protected function createAdministrator(): void
    {
        $adminPosition = Position::factory()->create([
            'id' => 1,
            'name' => 'Administrator',
        ]);

        //first main admin
        /** @var User $admin */
        $admin = User::factory()->create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $admin->assignPosition($adminPosition);
    }

}

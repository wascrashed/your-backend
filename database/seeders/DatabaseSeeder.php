<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            RolesAndPermissionsSeeder::class,
            StatusTypeSeeder::class,
            StatusSeeder::class
        ]);

        $user = \App\Models\User::create([
            'first_name' => 'Sorbon',
            'last_name' => 'D',
            'email' => 'ds@mail.ru',
            'password' => 'password',
            'status_id' => Status::USER_ACTIVE
        ]);

        $user->assignRole(1);
    }
}

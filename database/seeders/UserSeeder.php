<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'role' => 'administrator',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Manager',
                'username' => 'manager',
                'password' => bcrypt('manager'),
                'role' => 'manager',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cashier',
                'username' => 'cashier',
                'password' => bcrypt('cashier'),
                'role' => 'cashier',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        User::factory(100)->create();
    }
}

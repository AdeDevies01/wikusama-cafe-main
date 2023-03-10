<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 80; $i <= 110; $i++) {
            Table::create([
                'number' => $i,
                'desc' => 'Meja berada ' . ($i < 90) ? 'di lantai 1' : 'di lantai 2',
                'is_available' => true,
                'capacity' => rand(2, 10)
            ]);
        }
    }
}

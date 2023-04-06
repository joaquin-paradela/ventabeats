<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['description' => 'En proceso']);
        Status::create(['description' => 'Caducó']);
        Status::create(['description' => 'Realizada']);
        
    }
}

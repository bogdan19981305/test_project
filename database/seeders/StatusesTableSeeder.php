<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::updateOrCreate([
            'label' => 'New',
            'code' => 'new',
        ]);
        Status::updateOrCreate([
            'label' => 'In Progress',
            'code' => 'in_progress',
        ]);
        Status::updateOrCreate([
            'label' => 'Done',
            'code' => 'done',
        ]);
    }
}

<?php

namespace Database\Seeders\Diary;

use App\Models\Diary\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory(500)->create();
    }
}

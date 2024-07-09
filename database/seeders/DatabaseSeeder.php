<?php

namespace Database\Seeders;

use App\Models\Priority;
use App\Models\Task;
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


        //User::truncate();
        //Task::truncate();

        Priority::factory()->create(
            ['name' => 'Low',]
        );
        Priority::factory()->create(
            ['name' => 'Medium',]
        );
        Priority::factory()->create(
            ['name' => 'High',]
        );

        User::factory()->create([
            'name' => 'Aaron Mena',
            'email' => 'test@example.com',
        ]);

        $priorityDefault = Priority::all()->first();
        $UserDefault = User::all()->first();

        Task::factory(5)->create([
            'priority_id' => $priorityDefault->id,
            'user_id' => $UserDefault->id,
        ]);
    }
}

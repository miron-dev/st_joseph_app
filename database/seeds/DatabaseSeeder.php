<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(BuildingSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(PrioritySeeder::class);
        $this->call(StatSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(ApproveSeeder::class);
        // $this->call(CommentSeeder::class);
        // $this->call(TaskSeeder::class);
    }
}

<?php

use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    static $priorities = ['Sans','Urgent','Important'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$priorities as $priority) {
            DB::table('priorities')->insert([
                'name' => $priority,
            ]);
        }
        
    }
}

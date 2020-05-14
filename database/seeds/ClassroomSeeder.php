<?php

use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    static $classrooms = ['A','B','C','D','E','F','G','H','I'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$classrooms as $classroom) {
            for($class = 1; $class < 31; $class++) {
                DB::table('classrooms')->insert([
                    'name' => $classroom.$class,
                ]);
            }
        }
        
    }
}

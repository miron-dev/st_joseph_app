<?php

use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    static $buildings = ['A','B','C','D','E','F','G','H','I'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$buildings as $building) {
            DB::table('buildings')->insert([
                'name' => $building,
            ]);
        }
        
    }
}

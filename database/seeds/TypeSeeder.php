<?php

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    static $types = ['Admin','Professeur','Directeur','Agent','Secretaires'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$types as $type) {
            DB::table('types')->insert([
                'name' => $type,
            ]);
        }
        
    }
}

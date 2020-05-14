<?php

use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    static $stats = ['En attente','Fait','Reporte','En cours'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$stats as $stat) {
            DB::table('stats')->insert([
                'name' => $stat,
            ]);
        }
        
    }
}

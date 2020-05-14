<?php

use Illuminate\Database\Seeder;

class ApproveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('approves')->insert([
            [
                'name' => 'En attente',
            ],
            [
                'name' => 'Validé',
            ],
            [
                'name' => 'Non Validé',
            ]
        ]);
    }
}

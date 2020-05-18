<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create();

        DB::table('users')->insert([
            'name' => 'administrateur',
            'email' => 'a@a.com',
            'type_id' => 1,
            'approved_at' => now(),
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'traitant',
            'email' => 't@t.com',
            'type_id' => 4,
            'approved_at' => now(),
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'demandeur1',
            'email' => 'd1@d.com',
            'type_id' => 2,
            'approved_at' => now(),
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'demandeur2',
            'email' => 'd2@d.com',
            'type_id' => 2,
            'approved_at' => now(),
            'password' => bcrypt('password'),
        ]);
    }
}

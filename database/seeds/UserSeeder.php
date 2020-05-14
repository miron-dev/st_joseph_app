<?php

use Illuminate\Database\Seeder;

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
            'name' => 'admin',
            'email' => 'a@a.com',
            'type_id' => 1,
            'approved_at' => now(),
            'password' => bcrypt('password'),
        ]);
    }
}

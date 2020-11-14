<?php

use Illuminate\Database\Seeder;
use App\User;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('role_user')->insert([
            [
                'user_id' => User::all()->random()->id,
                'role_id' => 1
            ],
            [
                'user_id' => User::all()->random()->id,
                'role_id' => 2
            ]
        ]);
    }
}

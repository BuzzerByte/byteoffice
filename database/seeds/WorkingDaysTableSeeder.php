<?php

use Illuminate\Database\Seeder;
use App\User;

class WorkingDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('working_days')->insert([
            [
                'day' => 'saturday',
                'work'=> 0,
                'user_id' => User::all()->random()->id
            ],[
                'day' => 'sunday',
                'work'=> 0,
                'user_id' => User::all()->random()->id
            ],[
                'day' => 'monday',
                'work'=> 1,
                'user_id' => User::all()->random()->id
            ],[
                'day' => 'tuesday',
                'work'=> 1,
                'user_id' => User::all()->random()->id
            ],[
                'day' => 'wednesday',
                'work'=> 1,
                'user_id' => User::all()->random()->id
            ],[
                'day' => 'thursday',
                'work'=> 1,
                'user_id' => User::all()->random()->id
            ],[
                'day' => 'friday',
                'work'=> 1,
                'user_id' => User::all()->random()->id
            ]
        ]);
    }
}

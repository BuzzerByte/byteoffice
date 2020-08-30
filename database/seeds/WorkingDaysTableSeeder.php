<?php

use Illuminate\Database\Seeder;

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
                'user_id' => 1
            ],[
                'day' => 'sunday',
                'work'=> 0,
                'user_id' => 1
            ],[
                'day' => 'monday',
                'work'=> 1,
                'user_id' => 1
            ],[
                'day' => 'tuesday',
                'work'=> 1,
                'user_id' => 1
            ],[
                'day' => 'wednesday',
                'work'=> 1,
                'user_id' => 1
            ],[
                'day' => 'thursday',
                'work'=> 1,
                'user_id' => 1
            ],[
                'day' => 'friday',
                'work'=> 1,
                'user_id' => 1
            ]
        ]);
    }
}

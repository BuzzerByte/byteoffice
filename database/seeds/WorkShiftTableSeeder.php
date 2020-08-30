<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class WorkShiftTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('work_shifts')->insert([
            [
                'name' => 'Day Shift',
                'from' => '08:30',
                'to' => '17:30',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'name' => 'Evening Shift',
                'from' => '18:00',
                'to' => '7:00',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ]
        ]);
    }
}

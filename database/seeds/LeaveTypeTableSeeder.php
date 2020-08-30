<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class LeaveTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('leave_types')->insert([
            [
                'name' => 'Sick Leave',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'name' => 'Earn Leave',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'name' => 'Yearly Leave',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'name' => 'Medical Leave',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ]

        ]);
    }
}

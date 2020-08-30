<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class EmployeeStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('employee_statuses')->insert([
            [
                'status' => 'Full Time Contract',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'status' => 'Full-Time Permanent',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'status' => 'Full-Time Probation',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'status' => 'Part-Time Contract',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'status' => 'Part-Time Internship',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ]
        ]);
    }
}

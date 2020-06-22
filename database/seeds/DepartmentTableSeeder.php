<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departments')->insert([
            [
                'name' => 'QA Department',
                'description' =>  'QA Department',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'name' => 'Software Development',
                'description' =>  'Software Development',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'name' => 'Management',
                'description' =>  'Management',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'name' => 'Human Resource',
                'description' =>  'Human Resource',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'name' => 'Sales & Marketing',
                'description' =>  'Sales & Marketing',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'name' => 'Accounts',
                'description' =>  'Accounts',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'name' => 'Engineer',
                'description' =>  'Engineer',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ]
        ]);
    }
}

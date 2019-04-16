<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class JobTitleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('job_titles')->insert([
            [
                'title' => 'CEO',
                'description' => 'Chief Executive Officer',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'title' => 'Software Project ManagerR',
                'description' => 'Software Project ManagerR',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'title' => 'Accounts Clerk',
                'description' => 'Accounts Clerk',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'title' => 'Finance Manager	',
                'description' => 'Finance Manager',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'title' => 'IT Executive',
                'description' => 'IT Executive',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'title' => 'IT Manager',
                'description' => 'IT Manager',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'title' => 'HR Manager',
                'description' => 'HR Manager',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'title' => 'Sales Executive',
                'description' => 'Sales Executive',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'title' => 'Sales Manager',
                'description' => 'Sales Manager',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'title' => 'Software Development Manager',
                'description' => 'Software Development Manager',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'title' => 'Software Engineer',
                'description' => 'Software Engineer',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'title' => 'Technical Support Engineer',
                'description' => 'Technical Support Engineer',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],[
                'title' => 'Trainee',
                'description' => 'Trainee',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ]
        ]);
    }
}

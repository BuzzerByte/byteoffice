<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class JobCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('job_categories')->insert([
            [
                'category' => 'Craft Workers',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'category' => 'Laborers and Helpers',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'category' => 'Office and Clerical Workers',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'category' => 'Officials and Managers',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'category' => 'Operatives',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'category' => 'Professionals',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'category' => 'Sales Workers',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'category' => 'Service Workers',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'category' => 'Software Developer',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'category' => 'Technical Officer',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ],[
                'category' => 'Technicians',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => 1
            ]
        ]);
    }
}

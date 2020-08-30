<?php

use Illuminate\Database\Seeder;

class TaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        DB::table('taxes')->insert([
            [
                'name' => 'GST 50',
                'rate' =>  15,
                'type' => 'Percentage',
                'user_id' => 1
            ],[
                'name' => 'GST 0%',
                'rate' => 0,
                'type' => 'Percentage',
                'user_id' => 1
            ],[
                'name' => 'GST 15%',
                'rate' => 50,
                'type' => 'Percentage',
                'user_id' => 1
            ]
        ]);
    }
}

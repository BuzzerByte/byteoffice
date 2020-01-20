<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role=[
            [
                'name' => 'admin',
                'display_name' => 'System admin',
                'description' => 'Have all permission'
            ],[
                'name'=>  'user',
                'display_name'=> 'User',
                'description'=> 'Have limited permission'
            ]
        ];
        foreach($role as $key => $value){
            Role::create($value);
        }
    }
}

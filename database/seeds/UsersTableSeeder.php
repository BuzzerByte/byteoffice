<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'admin@buzzerbyte.com',
                'name' => 'admin',
                'f_name' => 'buzzer',
                'l_name' => 'admin',
                'terminate_status'=>false,
                'id_number' => 'b02321',
                'password' => bcrypt('123qwe'),
                'role'=>'admin'
            ],[
                'email' => 'user@buzzerbyte.com',
                'name' => 'user',
                'f_name' => 'buzzer',
                'l_name' => 'user',
                'terminate_status'=>false,
                'id_number'=> 'b02032',
                'password' => bcrypt('123qwe'),
                'role'=> 'user'
            ]
        ];
        foreach($users as $key => $value){
            User::create($value);
        }
    }
}

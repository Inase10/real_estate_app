<?php



namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

use App\Models\User;



class CreateUsersSeeder extends Seeder

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

               'first_name'=>'Admin User',

               'email'=>'admin@itsolutionstuff.com',

               'user_type'=>'Admin',

               'password'=> bcrypt('123456'),

            ],

            [

               'first_name'=>'Manager User',

               'email'=>'manager@itsolutionstuff.com',

               'user_type'=> 'Seller',

               'password'=> bcrypt('123456'),

            ],

            [

               'first_name'=>'User',

               'email'=>'user@itsolutionstuff.com',

               'type'=>'Customer',

               'password'=> bcrypt('123456'),

            ],

        ];



        foreach ($users as $key => $user) {

            User::create($user);

        }

    }

}

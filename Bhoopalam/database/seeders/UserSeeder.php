<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin
       $admin = User::create(
            [
                'name'=>'Admin',
                'email'=>'Admin@gmail.com',
                'email_verified_at' => now(),
                'password' =>Hash::make('123123123'), // password
                'remember_token' => Str::random(10),
            ]
        );
       $admin->attachRole('admin');
       event(new Registered($admin));

        // create Agent
       $agent = User::create(
            [
                'name'=>'Agent',
                'email'=>'Agent@gmail.com',
                'email_verified_at' => now(),
                'password' =>Hash::make('123123123'), // password
                'remember_token' => Str::random(10),
            ]
        );
       $agent->attachRole('agent');
       event(new Registered($agent));

        // create User
       $user = User::create(
            [
                'name'=>'User',
                'email'=>'User@gmail.com',
                'email_verified_at' => now(),
                'password' =>Hash::make('123123123'), // password
                'remember_token' => Str::random(10),
            ]
        );
       $user->attachRole('user');
       event(new Registered($user));


    }
}

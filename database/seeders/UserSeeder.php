<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new User();
        $user->first_name='Sarvarbek';
        $user->last_name='Matvapayev';
        $user->bio='Full Stack developer';
        $user->email='example@gmail.com';
        $user->password=Hash::make('example@gmail.com');
        $user->save();

        $user=new User();
        $user->first_name='System';
        $user->last_name='user';
        $user->bio='User for testing';
        $user->email='test@gmail.com';
        $user->password=Hash::make('test@gmail.com');
        $user->save();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'    => 'Abelito' ,
            'email'   => 'estevez8991@gmail.com' ,
            'password'=> Hash::make('Abelito8991*') ,
            'role'    => 'Admin' ,
            'phoneNumber'   => 5358297981,
            'cedula'    => 980402,
            'bdate' => now(),
            'zipcode'   => 98,
            'country'   => 'Cuba',
            'state' => 'La Habana',
            'city'  => 'Lisa',
        ]);
    }
}

<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Isaac',
            'email' => 'isaac@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://www.mi-sitio.com',
        ]);
        // $user->perfil()->create();

        $user2 = User::create([
            'name' => 'Roberto',
            'email' => 'roberto@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://www.mi-sitio.com',
        ]);
        // $user2->perfil()->create();
    
        
    }
}

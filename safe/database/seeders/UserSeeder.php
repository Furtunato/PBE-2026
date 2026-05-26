<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Coordenação AQV',
            'email' => 'admin@safe7.com',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ]);
        
        User::create([
            'name' => 'Professor Carlos',
            'email' => 'professor@safe7.com',
            'password' => bcrypt('123456'),
            'role' => 'professor'
        ]);
        
        User::create([
            'name' => 'Portaria João',
            'email' => 'portaria@safe7.com',
            'password' => bcrypt('123456'),
            'role' => 'portaria'
        ]);
        
        User::create([
            'name' => 'Responsável',
            'email' => 'responsavel@safe7.com',
            'password' => bcrypt('123456'),
            'role' => 'responsavel'
        ]);
    }
}
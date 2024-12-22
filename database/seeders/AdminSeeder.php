<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()   //1 ADMIN
    {
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@ehb.be',
            'verjaardag' => '1980-01-01',
            'profielfoto' => null,
            'bio' => 'Ik ben de standaard admin.',
            'password' => Hash::make('Password!321'),
            'isAdmin' => true,
        ]);
    }
}

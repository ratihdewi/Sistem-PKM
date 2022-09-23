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
        User::create([
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'),
            'role_id' => 1
        ]);
        // User::create([
        //     'username' => 'dosen',
        //     'name' => 'Dosen',
        //     'email' => 'dosen@gmail.com',
        //     'password' => Hash::make('12345'),
        //     'role_id' => 2
        // ]);
        // User::create([
        //     'username' => 'mahasiswa',
        //     'name' => 'Mahasiswa',
        //     'email' => 'mahasiswa@gmail.com',
        //     'password' => Hash::make('12345'),
        //     'role_id' => 3
        // ]);
    }
}

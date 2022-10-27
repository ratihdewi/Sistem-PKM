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

        User::create([
            'username' => 'dosen',
            'name' => 'Dosen',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('12345'),
            'role_id' => 2
        ]);

        // $username = ['mahasiswa1', 'mahasiswa2', 'mahasiswa3', 'mahasiswa4', 'mahasiswa5'];
        // $name = ['Mahasiswa 1', 'Mahasiswa 2', 'Mahasiswa 3', 'Mahasiswa 4', 'Mahasiswa 5'];
        // $email = ['mahasiswa1@gmail.com', 'mahasiswa2@gmail.com', 'mahasiswa3@gmail.com', 'mahasiswa4@gmail.com', 'mahasiswa5@gmail.com'];

        // for ($i = 0; $i < count($username); $i++) {
        //     User::create([
        //         'username' => $username[$i],
        //         'name' => $name[$i],
        //         'email' => $email[$i],
        //         'password' => Hash::make('12345'),
        //         'role_id' => 3
        //     ]);
        // }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Master\Prodi;
use App\Models\User;
use App\Services\SoapApiService;
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
            'nomor_induk' => '',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'),
            'role_id' => 1
        ]);

        User::create([
            'username' => 'dosen',
            'name' => 'Dosen',
            'nomor_induk' => '',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('12345'),
            'role_id' => 2
        ]);

        $soap = new SoapApiService();
        $client = $soap->execute();

        $token = $client->getToken('ods', '12345');

        $response = $client->getAllStudentsUsername($token);

        foreach (json_decode($response)->data as $data) {
            User::create([
                'prodi_id' => Prodi::where('name', $data->prodi)->first()->id,
                'username' => $data->username,
                'name' => $data->nama,
                'nomor_induk' => $data->nomor_induk,
                'email' => $data->email,
                'password' => Hash::make('12345'),
                'role_id' => 3
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Master\Prodi;
use App\Models\User;
use App\Services\MasayuApiService;
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
            'role_id' => 1,
            'position' => 'Admin'
        ]);

        User::create([
            'username' => 'dosen',
            'name' => 'Dosen',
            'nomor_induk' => '',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('12345'),
            'role_id' => 2,
            'position' => 'Dosen'
        ]);

        // $this->dosen_seeder();
        // $this->temp_dosen_seeder();

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

    // private function dosen_seeder()
    // {
    //     $masayu = new MasayuApiService();
    //     $client = $masayu->execute();

    //     $responses = $client->get('api/Lecturer');
    //     $results = json_decode($responses->getBody()->getContents(), true);
    //     $results = $results['data'];

    //     $results = array_filter($results, function ($item) {
    //         return (($item['username'] !== null && $item['name'] !== null && $item['nip'] !== null) && $item['position'] !== null);
    //     });

    //     $results = array_unique($results, SORT_REGULAR);
    //     $results = array_values($results);

    //     foreach ($results as $data) {
    //         User::create([
    //             'username' => $data['username'],
    //             'name' => $data['name'],
    //             'nomor_induk' => $data['nip'],
    //             'email' => $data['email'],
    //             'password' => Hash::make('12345'),
    //             'role_id' => 2,
    //             'position' => $data['position'],
    //         ]);
    //     }
    // }

    // private function temp_dosen_seeder()
    // {
    //     $masayu = new MasayuApiService();
    //     $client = $masayu->execute();

    //     $responses = $client->get('api/Lecturer');
    //     $results = json_decode($responses->getBody()->getContents(), true);
    //     $results = $results['data'];

    //     $results = array_filter($results, function ($item) {
    //         return (($item['username'] !== null && $item['name'] !== null && $item['nip'] !== null) && !empty($item['positions'])) && in_array(str_contains($item['positions'][0]['position'], 'Dosen'), array_column($item['positions'], 'position'));
    //     });

    //     $results = array_values($results);

    //     foreach ($results as $data) {
    //         User::create([
    //             'username' => $data['username'],
    //             'name' => $data['name'],
    //             'nomor_induk' => $data['nip'],
    //             'email' => $data['email'],
    //             'password' => Hash::make('12345'),
    //             'role_id' => 2,
    //             'position' => $data['positions'][0]['position'],
    //         ]);
    //     }
    // }
}

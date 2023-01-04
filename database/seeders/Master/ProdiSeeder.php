<?php

namespace Database\Seeders\Master;

use App\Models\Master\Prodi;
use App\Services\MasayuApiService;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = ['Teknik Geofisika', 'Teknik Geologi', 'Teknik Perminyakan', 'Teknik Elektro', 'Teknik Mesin', 'Teknik Kimia', 'Teknik Logistik', 'Manajemen', 'Ekonomi', 'Teknik Sipil', 'Teknik Lingkungan', 'Kimia', 'Ilmu Komputer', 'Komunikasi', 'Hubungan Internasional'];

        $masayu = new MasayuApiService();
        $client = $masayu->execute();

        $responses = $client->get('api/Organizations/show');
        $results = json_decode($responses->getBody()->getContents(), true);
        $data = $results['data'];

        foreach ($data as $item) {
            Prodi::create([
                'name' => substr($item['org_unit'], 14)
            ]);
        }
    }
}

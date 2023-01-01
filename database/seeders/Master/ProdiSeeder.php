<?php

namespace Database\Seeders\Master;

use App\Models\Master\Prodi;
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
        $data = ['Teknik Geofisika', 'Teknik Geologi', 'Teknik Perminyakan', 'Teknik Elektro', 'Teknik Mesin', 'Teknik Kimia', 'Teknik Logistik', 'Manajemen', 'Ekonomi', 'Teknik Sipil', 'Teknik Lingkungan', 'Kimia', 'Ilmu Komputer', 'Komunikasi', 'Hubungan Internasional'];

        foreach ($data as $item) {
            Prodi::create([
                'name' => $item
            ]);
        }
    }
}

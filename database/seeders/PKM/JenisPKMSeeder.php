<?php

namespace Database\Seeders\PKM;

use App\Models\Master\JenisPKM;
use Illuminate\Database\Seeder;

class JenisPKMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['PKM 8 Bidang', 'PKM Artikel Ilmiah', 'PKM Gagasan Futuristik Tertulis'];

        foreach ($data as $item) {
            JenisPKM::create([
                'name' => $item
            ]);
        }
    }
}

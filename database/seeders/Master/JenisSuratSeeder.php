<?php

namespace Database\Seeders\Master;

use App\Models\Master\JenisSurat;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Surat Keputusan', 'Adhoc', 'Tugas'];

        foreach ($data as $item) {
            JenisSurat::create([
                'name' => $item
            ]);
        }
    }
}

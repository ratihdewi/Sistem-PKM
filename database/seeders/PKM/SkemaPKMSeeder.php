<?php

namespace Database\Seeders\PKM;

use App\Models\PKM\SkemaPKM;
use Illuminate\Database\Seeder;

class SkemaPKMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['PKM Karsa Cipta', 'PKM Karya Inovatif', 'PKM Kewirausahaan', 'PKM Penerapan IPTEK', 'PKM Pengabdian Kepada Masyarakat', 'PKM Riset Eksakta', 'PKM Riset Sosial Humaniora', 'PKM Video Gagasan Konstruktif'];

        foreach ($data as $item) {
            SkemaPKM::create([
                'jenis_pkm_id' => 1,
                'name' => $item
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Database\Seeders\Master\JenisPKMSeeder;
use Database\Seeders\Master\JenisSuratSeeder;
use Database\Seeders\Master\ProdiSeeder;
use Database\Seeders\Master\SkemaPKMSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            ProdiSeeder::class,
            UserSeeder::class,
            JenisPKMSeeder::class,
            SkemaPKMSeeder::class,
            JenisSuratSeeder::class
        ]);
    }
}

<?php

namespace Database\Seeders;

use Database\Seeders\PKM\JenisPKMSeeder;
use Database\Seeders\PKM\SkemaPKMSeeder;
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
            UserSeeder::class,
            JenisPKMSeeder::class,
            SkemaPKMSeeder::class
        ]);
    }
}

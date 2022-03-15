<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();
        $this->call(Estados::class);
        \App\Models\Cidade::factory(10)->create();
        \App\Models\Campanha::factory(10)->create();
        \App\Models\GrupoCidade::factory(10)->create();
        \App\Models\Produtos::factory(10)->create();
    }
}

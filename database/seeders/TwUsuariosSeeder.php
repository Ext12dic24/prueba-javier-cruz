<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TwUsuarios;

class TwUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TwUsuarios::factory(10)->create();
    }
}

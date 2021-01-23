<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TwCorporativos;

class CorporativosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TwCorporativos::factory(10)->create();
        
    }
}

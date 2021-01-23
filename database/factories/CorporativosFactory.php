<?php

namespace Database\Factories;

use App\Models\TwCorporativos;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class CorporativosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TwCorporativos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'S_NombreCorto' => $this->faker->company,
            'S_NombreCompleto' => $this->faker->company,
            'S_LogoURL' => $this->faker->url,
            'S_DBName' => "AAAAAA",
            'S_DBUsuario' => $this->faker->userName,
            'S_DBPassword' => bcrypt('12345'),
            'S_SystemUrl' => $this->faker->url,
            'S_Activo' => 1,
            'D_FechaIncorporacion' => Carbon::now(),
            'tw_usuarios_id' => 1,
        ];
    }
}

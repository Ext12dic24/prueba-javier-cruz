<?php

namespace Database\Factories;

use App\Models\TwUsuarios;
use Illuminate\Database\Eloquent\Factories\Factory;

class TwUsuariosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TwUsuarios::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('12345'),
            'S_Nombre' => $this->faker->firstName,
            'S_Apellidos' => $this->faker->lastName,
            'S_FotoPerfilUrl' => $this->faker->imageUrl,
            'S_Activo' => 1,
            'verified' => '',
        ];
    }
}

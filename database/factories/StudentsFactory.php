<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Unique;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Students>
 */
class StudentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'surname'=> fake()->firstName(),
            'othername'=>fake()->firstName(),
            'dob'=>fake()->date(),
            'gender'=>fake()->numberBetween(1,2),
            'nationality'=>fake()->country(),
            'parent_name'=>fake()->name(),
            'lastclass'=>fake()->numberBetween(1,9),
            'level_id'=>fake()->numberBetween(1,9),
            'status'=>1,

        ];
    }
}

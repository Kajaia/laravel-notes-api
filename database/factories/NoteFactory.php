<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word() . ' ' . $this->faker->word() . ' ' . $this->faker->word(),
            'description' => $this->faker->text(200),
            'color' => $this->faker->randomElement($array = array ('bg-warning','bg-danger','bg-success','bg-primary','bg-secondary','bg-light')),
            'pinned' => $this->faker->boolean(),
            'archived' => $this->faker->boolean(),
            'label_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}

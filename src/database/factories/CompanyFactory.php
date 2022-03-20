<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => $this->faker->unique()->numberBetween(12,21),
            'company_name' => $this->faker->unique()->name(),
            'company_email' => $this->faker->unique()->safeEmail(),
            'company_phone' => $this->faker->phoneNumber(),
            'company_description'=>$this->faker->text(),
            'company_location'=>$this->faker->address(),
            'bedroom_price'=>$this->faker->numberBetween(1,5),
            'livingroom_price'=>$this->faker->numberBetween(1,5),
            'guestroom_price'=>$this->faker->numberBetween(1,5),
            'kitchen_price'=>$this->faker->numberBetween(1,5),
            'km_price'=>$this->faker->numberBetween(1,5),
            'pack_price'=>$this->faker->numberBetween(1,5),
            'company_image'=>$this->faker->randomElement(['slider.jpg','slider2.jpg','company.jpg','main.jpg'])
        ];
    }
}

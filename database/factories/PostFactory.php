<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arry=['Yangon','Mandalay','Chauk','Pyay',"Bago"];
        return [
           'title'=>$this->faker->sentence(5),
           'description'=>$this->faker->text(200),
           'price'=>rand(10000,50000),
           'address'=>$arry[array_rand($arry)],
           'rate'=>rand(0,5)
        ];
    }
}

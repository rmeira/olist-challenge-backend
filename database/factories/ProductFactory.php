<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'type_id' => Type::factory()->create()->id,
            'value' => $this->faker->randomFloat(4, 0, 100)
        ];
    }
}

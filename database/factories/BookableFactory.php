<?php

namespace Database\Factories;

use App\Models\Bookable;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class BookableFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bookable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $suffix = [
            'Villa',
            'House',
            'Cottage',
            'Luxury Villa',
            'Cheap House',
            'Room',
            'Cheap Room',
            'Luxury Room',
            'Fancy Room'
        ];
        return [
            'title' => $this->faker->city.' '.Arr::random($suffix),
            'description' => $this->faker->text()
        ];
    }
}
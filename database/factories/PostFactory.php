<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $datetime = $this->faker->dateTimeBetween('-1 month', 'now');

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => '<p>' . implode('</p><p>', $this->faker->paragraphs(rand(3, 5))) . '</p>',
            'created_at' => $datetime,
            'updated_at' => $datetime
        ];
    }
}

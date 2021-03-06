<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = \App\Models\Category::factory(10)
            ->create();

        \App\Models\User::factory(10)
            ->create()
            ->each(function($user) use($categories) {
                $posts = $user->posts()->saveMany(
                    \App\Models\Post::factory(10)
                        ->make()
                );

                $posts->each(function($post) use($categories) {
                    $post->categories()->attach($categories->random(2)->pluck('id')->toArray());
                });
            });

        \App\Models\Comment::factory(500)
            ->state(new Sequence(
                function() {
                    return [
                        'post_id' => rand(1, 100),
                        'user_id' => rand(1, 10),
                    ];
                }
            ))
            ->create();
    }
}

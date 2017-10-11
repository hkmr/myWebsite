<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 5)->create();
        // factory(App\User::class, 10)->create();
        // factory(App\Comment::class, 3000)->create();
        // factory(App\Category::class, 10)->create();

    }
}

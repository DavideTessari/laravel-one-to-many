<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Post;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 20; $i++) {
            $newPost = new Post();
            $newPost->name = $faker->sentence(3);
            $newPost->slug = Str::slug($newPost->name, '-');
            $newPost->client_name = $faker->company;
            $newPost->summary = $faker->paragraph;
            $newPost->save();
        }
    }
}
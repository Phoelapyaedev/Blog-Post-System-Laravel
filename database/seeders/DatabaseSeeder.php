<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Article::factory(20)->create();
        Comment::factory(40)->create();

        $list = ['News', 'Tech', 'Web', 'Mobile', 'Lang'];
        foreach ($list as $name) {
            Category::create(['name' => $name]);
        }

        User::factory()->create([
            "name" => "Alice",
            "email" => "alice@gmail.com",
        ]);
        User::factory()->create([
            "name" => "Bob",
            "email" => "bob@gmail.com",
        ]);
    }
}

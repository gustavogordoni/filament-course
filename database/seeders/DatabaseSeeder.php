<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(30)->create();
        Tag::factory(30)->create();
        $categories = Category::factory(30)->create();
        $posts = Post::factory(60)
            ->recycle($users)
            ->recycle($categories)
            ->create();
        $comments = Comment::factory(30)
            ->recycle($users)
            ->recycle($posts)
            ->create();
        $replies = Reply::factory(30)
            ->recycle($users)
            ->recycle($comments)
            ->create();

        User::factory()->create([
            "name" => "Test User",
            "email" => "test@example.com",
            "password" => bcrypt("12345"),
            "is_admin" => 1,
        ]);

        User::factory()->create([
            "name" => "Admin User",
            "email" => "admin@example.com",
            "password" => bcrypt("12345"),
            "is_admin" => 1,
        ]);
    }
}

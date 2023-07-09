<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        return [
            'user_id'=>1,
            'title'=>"Last Year",
            'body'=>"This is a last year."
        ];
    }
}

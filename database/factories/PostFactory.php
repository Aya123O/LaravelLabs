<?php
namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'created_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'updated_at' => now(),
        ];
    }

    // State for old posts (>2 years)
    public function old()
    {
        return $this->state(function (array $attributes) {
            return [
                'created_at' => Carbon::now()->subYears(rand(3, 5)),
            ];
        });
    }

    // State for recent posts (<2 years)
    public function recent()
    {
        return $this->state(function (array $attributes) {
            return [
                'created_at' => Carbon::now()->subYears(rand(0, 1))->subDays(rand(1, 364)),
            ];
        });
    }
}
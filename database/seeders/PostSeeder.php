<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder; // Add this import
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Create 400 random posts (some will be old, some new)
        Post::factory(400)->create();
        
        // Create 50 specifically old posts (>2 years)
        Post::factory(50)->old()->create();
        
        // Create 50 specifically recent posts (<2 years)
        Post::factory(50)->recent()->create();
        
        // Create edge cases
        Post::factory()->create([
            'created_at' => Carbon::now()->subYears(2)->subDay() // Should be pruned
        ]);
        Post::factory()->create([
            'created_at' => Carbon::now()->subYears(2)->addDay() // Should remain
        ]);
    }
}
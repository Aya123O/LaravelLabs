<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PruneOldPostsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $maxExceptions = 1;
    public $timeout = 60;

    public function handle()
    {
        $cutoff = now()->subYears(2)->format('Y-m-d H:i:s');
        // Log the cutoff time          
    
    
        // Get posts to delete (for logging)
        $postsToDelete = DB::table('posts')
            ->where('created_at', '<', $cutoff)
            ->get();

    
        // Log posts before deletion
        Log::info("Posts to delete:", $postsToDelete->toArray());
    
        // Delete posts and log the count
        $deletedCount = DB::table('posts')
            ->where('created_at', '<', $cutoff)
            ->delete();
    
        Log::info("Deleted {$deletedCount} posts older than {$cutoff}");
    
        return $deletedCount;
    }
    
}
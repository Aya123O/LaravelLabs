<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('posts', 'slug')) {
                $table->string('slug')->unique()->after('title');
            }
            
            if (!Schema::hasColumn('posts', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }
    
   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

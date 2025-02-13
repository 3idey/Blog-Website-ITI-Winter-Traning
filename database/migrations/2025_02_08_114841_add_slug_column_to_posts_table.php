<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Post;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title'); // Add slug column
        });

        // Ensure existing posts have unique slugs
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->slug = Str::slug($post->title) . '-' . $post->id;
            $post->save();
        }

        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->unique()->change(); // Add unique constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('slug'); // Remove slug column
        });
    }
};

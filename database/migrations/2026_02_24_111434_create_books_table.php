<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
     Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('isbn')->unique();
        $table->unsignedBigInteger('author_id');
        $table->unsignedBigInteger('category_id');
        
        // Add it here once, and make it nullable
        $table->string('cover_image')->nullable(); 
        
        $table->text('description')->nullable();
        $table->date('published_at');
        $table->timestamps();
        
        // Foreign keys (if you are using them)
        $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

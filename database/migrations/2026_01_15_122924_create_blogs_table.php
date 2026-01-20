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
        Schema::create('blogs', function (Blueprint $table) {
              $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('category_id')->constrained()->restrictOnDelete();

    $table->string('title');
    $table->string('slug')->unique();
    $table->longText('content');
    $table->string('featured_image')->nullable();

    $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
    $table->unsignedBigInteger('view_count')->default(0);

    $table->string('meta_title')->nullable();
    $table->string('meta_description')->nullable();

    $table->softDeletes();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

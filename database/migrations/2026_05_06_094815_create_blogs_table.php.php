<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->string('slug')->unique();

            $table->text('excerpt')->nullable();

            $table->longText('content');

            $table->string('featured_image')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Relationships
            |--------------------------------------------------------------------------
            */

            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');

            $table->foreignId('author_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status',
                ['draft', 'published'])
                ->default('draft');

            $table->timestamp('published_at')
                  ->nullable();

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            $table->string('meta_title')
                  ->nullable();

            $table->text('meta_description')
                  ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('title');  // Title of the blog
            $table->string('slug')->unique();  // Slug for the blog (unique)
            $table->string('short_description');  // Short description of the blog
            $table->text('description');  // Full description of the blog
            $table->string('category');  // Category of the blog
            $table->string('tag')->nullable();  // Tag(s) for the blog, nullable
            $table->unsignedBigInteger('added_by');  // ID of the admin who added the blog
            $table->string('image')->nullable();  // Blog image (nullable)
            $table->tinyInteger('status')->default(1);  // Status of the blog (default 1 - active)
            $table->string('credit')->nullable();  // Credit for the blog (nullable)
            $table->string('credit_url')->nullable();  // URL for credit (nullable)
            $table->boolean('featured')->default(0);  // Featured flag (default 0 - not featured)
            $table->integer('orderby')->default(0);  // Order number for sorting blogs (default 0)
            $table->softDeletes();  // For soft deletes (deleted_at)

            $table->timestamps();  // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}

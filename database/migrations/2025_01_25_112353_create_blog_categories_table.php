<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('title');  // Title of the blog category
            $table->string('slug')->unique();  // Slug for the category (unique)
            $table->tinyInteger('status')->default(1);  // Status of the category (1 = active, 0 = inactive)
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
        Schema::dropIfExists('blog_categories');
    }
}

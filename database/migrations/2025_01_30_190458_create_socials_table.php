<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socials', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Social media name (e.g., Facebook, Twitter)
            $table->string('slug')->unique();  // Slug for the blog (unique)
            $table->string('link'); // Link to the social media page/profile
            $table->string('icon'); // Font Awesome or other icon class
            $table->string('image')->nullable(); // URL or path for the image (nullable)
            $table->string('orderby')->nullable(); // URL or path for the image (nullable)
            $table->boolean('status')->default(1); // Active status, 1 for active, 0 for inactive
            $table->softDeletes(); // Soft delete column (deleted_at)
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socials');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->text('content1')->nullable();  // Content columns can be nullable
            $table->text('content2')->nullable();
            $table->text('content3')->nullable();
            $table->text('content4')->nullable();
            $table->text('content5')->nullable();
            $table->text('content6')->nullable();
            $table->text('content7')->nullable();
            $table->text('content8')->nullable();
            $table->string('image1')->nullable();  // Image file names or URLs (nullable)
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('attachment1')->nullable();  // Attachment (nullable)
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
        Schema::dropIfExists('home_pages');
    }
}

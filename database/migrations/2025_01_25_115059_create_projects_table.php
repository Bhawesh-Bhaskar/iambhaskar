<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('title');  // Project title
            $table->string('slug')->unique();  // Slug (URL-friendly identifier)
            $table->string('link')->nullable();  // Project link (nullable)
            $table->string('image')->nullable();  // Project image (nullable)
            $table->tinyInteger('status')->default(1);  // Status (default to 1, active)
            $table->integer('orderby')->default(0);  // Order by value (default to 0)
            $table->string('company')->nullable();  // Company associated with the project (nullable)
            $table->softDeletes();  // Soft delete (nullable `deleted_at` column)
            $table->timestamps();  // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}

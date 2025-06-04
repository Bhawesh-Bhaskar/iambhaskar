<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('title');  // The title of the technology (e.g., "Laravel", "React")
            $table->string('slug')->unique();  // Slug for the technology (e.g., "laravel", "react")
            $table->string('icon')->nullable();  // Icon associated with the technology (nullable)
            $table->text('description')->nullable();  // Description of the technology (nullable)
            $table->tinyInteger('status')->default(1);  // Status of the technology (default 1, active)
            $table->integer('orderby')->nullable();  // Order of the technology (nullable, for sorting)
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
        Schema::dropIfExists('technologies');
    }
}

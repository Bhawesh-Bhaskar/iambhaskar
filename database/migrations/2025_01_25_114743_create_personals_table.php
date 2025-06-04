<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('name');  // Name of the person
            $table->string('email1')->nullable();  // First email (nullable)
            $table->string('email2')->nullable();  // Second email (nullable)
            $table->string('phone1')->nullable();  // First phone number (nullable)
            $table->string('phone2')->nullable();  // Second phone number (nullable)
            $table->string('whatsapp')->nullable();  // WhatsApp number (nullable)
            $table->date('dob')->nullable();  // Date of birth (nullable)
            $table->string('website')->nullable();  // Website URL (nullable)
            $table->integer('age')->nullable();  // Age (nullable)
            $table->string('qualification')->nullable();  // Qualification (nullable)
            $table->string('location')->nullable();  // Location (nullable)
            $table->text('map')->nullable();  // Map (nullable, could be coordinates or URL)
            $table->boolean('freelance')->default(false);  // Freelance status (default to false)
            $table->text('experience')->nullable();  // Experience (nullable)
            $table->softDeletes();  // Soft delete (nullable deleted_at column)
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
        Schema::dropIfExists('personals');
    }
}

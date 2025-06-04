<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('short_name')->unique();  // Short name of the country (e.g., 'US')
            $table->string('name');  // Full name of the country (e.g., 'United States')
            $table->string('iso3')->unique();  // ISO 3166-1 3-letter country code (e.g., 'USA')
            $table->string('number_code');  // ISO 3166-1 numeric country code (e.g., '840')
            $table->string('phone_code');  // International phone code (e.g., '+1')
            $table->string('currency_code');  // Currency code (e.g., 'USD')
            $table->string('flag')->nullable();  // URL or path to the country's flag image
            $table->tinyInteger('status')->default(1);  // Status (1 = active, 0 = inactive)
            $table->softDeletes();  // Soft delete (deleted_at column)
            $table->timestamps();  // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}

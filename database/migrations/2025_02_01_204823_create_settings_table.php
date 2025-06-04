<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('google_recaptcha_key')->nullable();
            $table->string('google_recaptcha_secret')->nullable();
            $table->string('google_analytics_code')->nullable();
            $table->string('google_firebase_key')->nullable();
            $table->string('version')->nullable();
            $table->timestamps();  // This will add created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}

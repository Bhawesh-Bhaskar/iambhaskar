<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_settings', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('subject');  // Subject of the maintenance setting
            $table->string('slug')->unique();  // Slug for the blog (unique)
            $table->date('date');  // Date of maintenance
            $table->time('from_time');  // Start time of maintenance
            $table->time('to_time');  // End time of maintenance
            $table->text('message');  // Message related to the maintenance
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
        Schema::dropIfExists('maintenance_settings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->unsignedBigInteger('user_id')->nullable();  // User ID (nullable if the activity is not associated with a user)
            $table->string('type');  // Type of activity (e.g., login, logout, update)
            $table->string('ip_address');  // IP address from which the activity was performed
            $table->string('city')->nullable();  // City where the activity took place (nullable)
            $table->string('country')->nullable();  // Country where the activity took place (nullable)
            $table->text('browser_agent')->nullable();  // Browser agent (nullable, can be useful for tracking browser/device info)
            $table->tinyInteger('status')->default(1);  // Status of the activity log (default 1, active)
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
        Schema::dropIfExists('activity_logs');
    }
}

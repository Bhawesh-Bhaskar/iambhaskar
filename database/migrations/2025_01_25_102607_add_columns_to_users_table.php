<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add new columns
            $table->string('user_id')->nullable();  // You can make this nullable or unique, depending on your requirement.
            $table->string('phone')->nullable();
            $table->string('email_verification_token')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(0);  // Default value 0
            $table->tinyInteger('email_verification')->default(0);  // Default value 0
            $table->tinyInteger('phone_verification')->default(0);  // Default value 0
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('linkedin_id')->nullable();
            $table->softDeletes();  // Adding `deleted_at` column for soft deletes

            // Modify the column order to place `deleted_at` before `created_at` (if you need to enforce this in the database, use a DB helper)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the columns that were added
            $table->dropColumn([
                'user_id',
                'phone',
                'email_verification_token',
                'image',
                'status',
                'email_verification',
                'phone_verification',
                'facebook_id',
                'google_id',
                'linkedin_id',
            ]);
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->unsignedBigInteger('user_id');  // User ID who the notification belongs to
            $table->string('user_type');  // User type (e.g., 'App\Models\User')
            $table->string('notification_type');  // Type of notification (e.g., 'message', 'alert')
            $table->text('description');  // The notification message or description
            $table->string('url_to_go')->nullable();  // URL to redirect when the notification is clicked
            $table->boolean('read_status')->default(false);  // Whether the notification has been read or not
            $table->tinyInteger('status')->default(1);  // Status of the notification (1 = active, 0 = inactive)
            $table->softDeletes();  // Soft delete (deleted_at column)
            $table->timestamps();  // Created at and updated at timestamps

            // Foreign key constraints if needed (assuming there is a users table)
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}

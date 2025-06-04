<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('assignee')->nullable();
            $table->unsignedBigInteger('user_id');  // The user who replied to the ticket
            $table->unsignedBigInteger('ticket_id');  // The associated ticket ID
            $table->text('message');  // The message content of the reply
            $table->string('user_type');  // Type of user (e.g., 'admin', 'user')
            $table->enum('read_status', ['read', 'unread']);
            $table->string('image')->nullable();
            $table->softDeletes();  // Soft delete (deleted_at column)
            $table->timestamps();  // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_replies');
    }
}

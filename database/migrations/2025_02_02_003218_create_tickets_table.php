<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Adds an auto-incrementing primary key column (id).
            $table->string('subject');
            $table->string('slug')->unique();
            $table->text('message');
            $table->string('assignee')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['open', 'closed', 'pending']); // Example status values, modify as needed
            $table->enum('read_status', ['read', 'unread']);
            $table->string('code')->unique();
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->string('image')->nullable();
            $table->enum('type', ['bug', 'feature', 'question']); // Example types, modify as needed
            $table->timestamp('last_reply')->nullable();
            $table->softDeletes();  // Soft delete (deleted_at column)
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
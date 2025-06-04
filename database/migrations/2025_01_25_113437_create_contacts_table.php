<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('name');  // Name of the contact
            $table->string('email');  // Email of the contact
            $table->string('phone')->nullable();  // Phone number of the contact (nullable)
            $table->string('subject');  // Subject of the message
            $table->text('message');  // Message content
            $table->tinyInteger('status')->default(1);  // Status of the contact request (1 = active, 0 = inactive)
            $table->softDeletes();  // For soft deletes (deleted_at)

            $table->timestamps();  // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}

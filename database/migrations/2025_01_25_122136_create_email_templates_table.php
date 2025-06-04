<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('temp_id')->unique();  // Template ID (unique)
            $table->string('subject');  // Subject of the email
            $table->text('body');  // Body of the email (HTML or plain text)
            $table->string('type');  // Type of email (e.g., transactional, promotional)
            $table->tinyInteger('status')->default(1);  // Status of the template (1 = active, 0 = inactive)
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
        Schema::dropIfExists('email_templates');
    }
}

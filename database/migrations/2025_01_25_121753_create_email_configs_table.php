<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_configs', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('email_protocol')->default('smtp');  // Email protocol (e.g., smtp, sendmail)
            $table->string('email_encryption')->nullable();  // Encryption type (e.g., tls, ssl, null)
            $table->string('smtp_host');  // SMTP host
            $table->integer('smtp_port')->default(587);  // SMTP port (default to 587)
            $table->string('smtp_email');  // SMTP email address
            $table->string('smtp_username');  // SMTP username
            $table->string('smtp_password');  // SMTP password
            $table->string('from_address');  // From email address
            $table->string('from_name');  // From name (sender's name)
            $table->tinyInteger('status')->default(1);  // Status (1 = active, 0 = inactive)
            $table->string('notification_email')->nullable();  // Notification email address (optional)
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
        Schema::dropIfExists('email_configs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            
            // Admin-specific columns
            $table->string('name');  // Name of the admin
            $table->string('role_id'); // Assuming you have a `roles` table
            $table->string('email')->unique();  // Admin email
            $table->string('phone')->nullable();  // Admin phone number
            $table->string('image')->nullable();  // Admin image (profile picture)
            $table->string('password');  // Admin password
            $table->rememberToken();  // For "remember me" functionality
            $table->tinyInteger('status')->default(1);  // Default status, 1 = active, 0 = inactive
            $table->tinyInteger('fa_status')->default(0);  // 0 = disabled, 1 = enabled for 2FA
            $table->string('googlefa_secret')->nullable();  // Secret for Google Authenticator (if 2FA enabled)
            $table->timestamp('fa_expiring')->nullable();  // Expiry timestamp for 2FA (optional)
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
        Schema::dropIfExists('admins');
    }
}

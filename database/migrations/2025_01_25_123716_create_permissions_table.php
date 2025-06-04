<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('group');  // Group to which the permission belongs (e.g., 'Admin', 'User')
            $table->string('name')->unique();  // Unique name for the permission (e.g., 'view_dashboard')
            $table->string('display_name');  // Human-readable name for the permission (e.g., 'View Dashboard')
            $table->text('description');  // Description of what the permission allows
            $table->string('user_type');  // User type for which this permission is applicable (e.g., 'Admin', 'User')
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
        Schema::dropIfExists('permissions');
    }
}

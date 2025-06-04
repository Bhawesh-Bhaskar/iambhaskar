<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // auto-incrementing primary key
            $table->string('name'); // role name
            $table->string('display_name'); // human-readable name for the role
            $table->text('description')->nullable(); // description of the role
            $table->string('user_type'); // type of user the role is associated with (e.g. 'admin', 'customer')
            $table->tinyInteger('status')->default(1); // role status (1: active, 0: inactive)
            $table->softDeletes(); // to handle soft deletes (deleted_at column)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}

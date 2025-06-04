<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backups', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Name of the backup
            $table->unsignedBigInteger('created_by'); // The user who created the backup
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Backup status (pending, completed, failed)
            $table->softDeletes(); // Soft delete column (deleted_at)
            $table->timestamps(); // Created at and updated at timestamps

            // Add foreign key constraint for `created_by` if you have a `users` table (assuming `id` in users)
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('backups');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign key to users table
            $table->foreignId('blog_id')->constrained()->onDelete('cascade');  // Foreign key to blogs table
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');  // For nested comments (parent comment)
            $table->text('comment');  // The actual comment content
            $table->integer('like')->default(0);  // Number of likes (default is 0)
            $table->tinyInteger('status')->default(1);  // Status of the comment (1 = active, 0 = inactive)
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
        Schema::dropIfExists('comments');
    }
}

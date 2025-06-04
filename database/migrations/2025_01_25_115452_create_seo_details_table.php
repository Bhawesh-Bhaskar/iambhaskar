<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_details', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('seo_title')->nullable();  // SEO title for general page (nullable)
            $table->text('seo_description')->nullable();  // SEO description for general page (nullable)
            $table->string('seo_keywords')->nullable();  // SEO keywords for general page (nullable)
            $table->string('canonical')->nullable();  // Canonical URL for general page (nullable)
            $table->string('blog_seo_title')->nullable();  // SEO title for blog page (nullable)
            $table->text('blog_seo_description')->nullable();  // SEO description for blog page (nullable)
            $table->string('blog_seo_keywords')->nullable();  // SEO keywords for blog page (nullable)
            $table->string('blog_canonical')->nullable();  // Canonical URL for blog page (nullable)
            $table->tinyInteger('status')->default(1);  // Status (default to 1, active)
            $table->softDeletes();  // Soft delete (nullable `deleted_at` column)
            $table->timestamps();  // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_details');
    }
}

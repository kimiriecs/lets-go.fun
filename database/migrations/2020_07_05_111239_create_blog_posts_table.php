<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('blog_category_id');

            $table->string('slug')->unique();
            $table->string('title'); 

            $table->text('excerpt')->nullable();

            $table->text('content_raw')->nullable();
            $table->text('content_html')->nullable();

            $table->boolean('is_published')->nullable()->default(false);
            $table->timestamp('published_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            $table->index('is_published');
        });
        // Schema::table('blog_posts', function (Blueprint $table) {
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
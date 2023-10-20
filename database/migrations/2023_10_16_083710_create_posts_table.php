<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
                    
            $table->string('title', 100);
            $table->enum('status',array('draft','published'))->default('draft');
            $table->text('content');
            $table->integer('user_id',)->index('user_id_foreign');

            $table->timestamps();
        });    
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};

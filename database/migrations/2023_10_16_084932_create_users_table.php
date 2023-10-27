<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->primary;
            $table->string('user_name', 100)->nullable(false);
            $table->string('user_email', 100)->nullable(false);
            $table->enum('user_gender', ['male','female'])->default('male');
            $table->string('user_password', 255)->nullable(false);
            $table->integer('user_phone_number')->nullable(false);
            $table->enum('user_role', ['admin', 'user'])->default('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

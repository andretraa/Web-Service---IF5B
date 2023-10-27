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
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100)->nullable(false);
            $table->string('email', 50)->nullable(false);
            $table->string('judul', 50)->nullable(false);            
            $table->string('author')->nullable(false);
            $table->enum('gender', ['male','female'])->default('male');
            $table->string('description', 100)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};

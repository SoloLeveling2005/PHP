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
        Schema::create('games', function(Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('author')->references('id')->on('users')->onDelete('cascade');
            $table->string('slug');
            $table->string('description');
//            $table->bigInteger('author');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('games');
    }
};

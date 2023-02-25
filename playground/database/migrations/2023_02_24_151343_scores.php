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
        Schema::create('scores', function (Blueprint $table) {
           $table->id();
//           $table->bigInteger('user');
           $table->foreignId('user')->references('id')->on('users')->onDelete('cascade');
           $table->string('game versions');
           $table->float('score');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('scores');
    }
};

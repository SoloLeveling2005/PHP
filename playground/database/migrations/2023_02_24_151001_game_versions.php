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
        Schema::create('game versions', function (Blueprint $table) {
            $table->id();
//            $table->bigInteger('game');
            $table->foreignId('game')->references('id')->on('games')->onDelete('cascade');
            $table->string('files');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('game versions');
    }
};

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
        Schema::create('modes', function (Blueprint $table) {
            $table->id();
            $table->string('text')->nullable();
            $table->string('text_top')->nullable();
            $table->string('text_bottom')->nullable();
            $table->integer('mode');
            $table->integer('delay')->default(1000);
            $table->boolean('scroll')->default(false);
            $table->boolean('scroll_top')->default(false);
            $table->boolean('scroll_bottom')->default(false);
            $table->boolean('show_clock')->default(false);
            $table->boolean('change_top')->default(false);
            $table->boolean('change_bottom')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modes');
    }
};

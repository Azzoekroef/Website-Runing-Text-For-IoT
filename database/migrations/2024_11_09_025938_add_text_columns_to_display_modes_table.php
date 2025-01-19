<?php

// app/Http/Controllers/DisplayModeController.php

// database/migrations/xxxx_xx_xx_create_display_modes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTextColumnsToDisplayModesTable extends Migration
{
    public function up()
    {
        Schema::create('mode_text', function (Blueprint $table) {
            $table->id();
            $table->string('text1');
            $table->string('text2')->nullable();
            $table->tinyInteger('mode');      // 1: Full Text, 2: Two-line Text, 3: Half Clock, Half Text
            $table->integer('delay1');         // Delay in milliseconds
            $table->integer('delay2')->nullable();         // Delay in milliseconds
            $table->integer('direction1');     // true: Left to Right, false: Right to Left
            $table->integer('direction2')->nullable();     // true: Left to Right, false: Right to Left
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mode_text');
    }
}

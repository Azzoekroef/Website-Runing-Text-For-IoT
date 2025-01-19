<?php

// app/Http/Controllers/DisplayModeController.php

// database/migrations/xxxx_xx_xx_create_display_modes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplayModesTable extends Migration
{
    public function up()
    {
        Schema::create('display_modes', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->tinyInteger('mode');      // 1: Full Text, 2: Two-line Text, 3: Half Clock, Half Text
            $table->integer('delay');         // Delay in milliseconds
            $table->string('direction');     // true: Left to Right, false: Right to Left
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('display_modes');
    }
}

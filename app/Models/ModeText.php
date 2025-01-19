<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeText extends Model
{
    use HasFactory;
    protected $table = 'mode_text';  // Adjust the table name as necessary

    // Define the fillable properties to prevent mass-assignment vulnerabilities
    protected $fillable = [
        'text1',
        'text2',
        'mode',
        'delay1',
        'delay2',
        'direction1',
        'direction2',
    ];
}

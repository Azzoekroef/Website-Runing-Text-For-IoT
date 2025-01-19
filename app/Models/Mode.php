<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    use HasFactory;

    protected $table = 'mode';  // Adjust the table name as necessary

    // Define the fillable properties to prevent mass-assignment vulnerabilities
    protected $fillable = [
        'text',
        'text_top',
        'text_bottom',
        'mode',
        'delay',
        'scroll',
        'scroll_top',
        'scroll_bottom',
        'show_clock',
        'change_top',
        'change_bottom',
    ];
}

<?php
// database/migrations/xxxx_xx_xx_create_display_modes_table.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisplayMode extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'display_modes';  // Adjust the table name as necessary

    // Define the fillable properties to prevent mass-assignment vulnerabilities
    protected $fillable = [
        'text',
        'mode',
        'delay',
        'direction',
    ];
}

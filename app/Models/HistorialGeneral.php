<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialGeneral extends Model
{
    use HasFactory;
    protected $fillable = [
        "evento",
        "fecha"
    ];
}

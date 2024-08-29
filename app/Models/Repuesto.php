<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    use HasFactory;
    protected $timestamps = true;
    protected $fillable = [
        'cantidad',
        'nombre',
        'descripcion',
        'imagen',
        'fabricante',
        'modelo',
    ];
}

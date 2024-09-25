<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Repuesto extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidad',
        'nombre',
        'descripcion',
        'imagen',
        'fabricante',
        'modelo',
    ];
    public function categoria() : BelongsTo{
        return $this->belongsTo(CategoriaRepuesto::class, "nombre", "categoria");
    }
}

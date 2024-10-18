<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Repuesto extends Model
{
    use HasFactory;
    protected $fillable = [
        "categoria",
        'cantidad',
        'nombre',
        'descripcion',
        'imagen',
        'fabricante',
        'modelo',
    ];
    public function categoria() : BelongsTo{
        return $this->belongsTo(CategoriaRepuesto::class, "categoria","nombre");
    }
}

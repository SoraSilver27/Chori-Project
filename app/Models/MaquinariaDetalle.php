<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaquinariaDetalle extends Model
{
    use HasFactory;
    protected $fillable = [

    ];

    public function maquinaria() : BelongsTo{
        return $this->belongsTo(Maquinaria::class, 'id', 'maquinaria_id');
    }
}

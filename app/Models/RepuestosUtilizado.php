<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RepuestosUtilizado extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidad',
        'nombre_repuesto',
    ];
    public function planilla()
    {
        return $this->belongsTo(Planilla::class, 'id_planilla', "id");
    }

}

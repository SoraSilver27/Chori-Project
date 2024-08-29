<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaDelCalendario extends Model
{
    use HasFactory;
    protected $timestamps = true;
    protected $fillable = ["evento","fecha"];
}

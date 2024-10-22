<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reticula extends Model
{
    /** @use HasFactory<\Database\Factories\ReticulaFactory> */
    use HasFactory;

    protected $fillable = ['idReticula', 'Descripcion', 'fechaEnVigor', 'carrera_id'];

    // Define la relación con el modelo Carrera
    public function Carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }
}

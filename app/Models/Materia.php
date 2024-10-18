<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materia extends Model
{
    /** @use HasFactory<\Database\Factories\MateriaFactory> */
    use HasFactory;

     // Define la relación con Carrera
     public function Carrera(): BelongsTo
     {
         return $this->belongsTo(Carrera::class, 'carrera_id');
     }
 
     protected $fillable = [
         'idMateria',
         'nombreMateria',
         'nivel',
         'nombreMediano',
         'nombreCorto',
         'modalidad',
         'carrera_id',
     ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory;
    use SoftDeletes; // Permite revertir deletes. usa una columna "deleted_at" para ocultar el recurso en lugar de borrarlo.

    protected $casts = [
        'data' => 'array', // deserializa el JSON de la columna 'data'
    ];

    protected $fillable = [
        'data'
    ];

}


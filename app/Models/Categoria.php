<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function productos(){
        return $this->belongsToMany(Producto::class)->withTimestamps();
    }

    public function caracteristica(){
        return $this->belongsTo(Caracteristica::class);
    }

    protected $fillable = [
        'caracteristica_id',
        // 'codigo',
        // 'nombre',
        // 'stock',
        // 'descripcion',
        // 'fecha_vencimiento',
        // 'img_path',
        // 'estado',
        // 'marca_id',
        // 'presentaciones_id',
    ];
}

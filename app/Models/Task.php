<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
    use HasFactory;

    //campos a rellenar
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
    ];

    //una tarea pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //funcion para tener las opciones del campo Status que es un Enum
    public static function getStatusOptions()
    {

        return [
            'Pendiente' => 'Pendiente',
            'En proceso' => 'En proceso',
            'Terminada' => 'Terminada'
        ];

    }
}

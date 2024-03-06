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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'visible'
    ];

    protected $casts = [
        'visible' => 'boolean' 
    ];
    // relacionamento n para 1
    public function user()
    {
        return $this->belongsTo(User::class); //  outros parâmetros passados por default por termos seguido nomenclatura padrão
    }
}

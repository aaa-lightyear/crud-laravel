<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Curso;

class Cliente extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'email',
        'linguagem',
        'nivel',
        'imagem',
        'curso_id',
        'user_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
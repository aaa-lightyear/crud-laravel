<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Cliente;

class Curso extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome', 'user_id'];

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
}
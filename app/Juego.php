<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    protected $table        = 'juegos';
    protected $primaryKey   = 'id_juego';
    public $timestamps      = false;
}

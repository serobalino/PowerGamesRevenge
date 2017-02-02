<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amigo extends Model
{
    protected $table        = 'amigos';
    protected $primaryKey   = ['id','use_id'];
    public $timestamps      = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reta extends Model
{
    protected $table        = 'retar';
    protected $primaryKey   = ['id_pub','id'];
    public $timestamps      = false;
}

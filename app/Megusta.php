<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Megusta extends Model
{
    protected $table        = 'megusta';
    protected $primaryKey   = false;
    public $timestamps      = false;

    public function publicacion(){
        return $this->belongsTo('Publicacion');
    }
}

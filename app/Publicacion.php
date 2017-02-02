<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model{

    protected $table        = 'publicaciones';
    protected $primaryKey   = 'id_pub';
    public $timestamps      = false;

    public function megusta(){
        return $this->hasMany('Megusta');
    }

}

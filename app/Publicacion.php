<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model{

        protected $table        = 'publicaciones';
        protected $primaryKey   = 'id_pu';
        public $timestamps      = false;
        protected $fillable     = ['id','detalle_pub'];

}

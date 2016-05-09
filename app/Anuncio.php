<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model {

       protected $table = 'anuncios';
       protected $primaryKey = "id";
       protected $fillable = ['titulo', 'descripcion', 'precio'];
       protected $guarded = [];


        //retorna los anuncios que pertenecen a la categoria
        public function categoria(){
            return $this->belongsTo('App\Categoria');
        }

}

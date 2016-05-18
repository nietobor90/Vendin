<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model {

       protected $table = 'anuncios';
       protected $primaryKey = "id";
       protected $fillable = ['titulo', 'descripcion', 'precio', 'categoria', 'user'];
       protected $guarded = [];


        //retorna los anuncios que pertenecen a la categoria
        public function categoria(){
            return $this->belongsTo('App\Categoria');
        }

        public function scopeAnuncioOK($query)
	    {
	        return $query->where('id', '!=', '0');
	    }

}

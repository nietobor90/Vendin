<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {

	protected $table = "categorias";
        protected $primaryKey = "id";
        protected $fillable = ['nombre'];
        protected $guarded = [];
        
        //retorna los anuncios que pertenecen a la categoria
        public function anuncios(){
            return $this->hasMany('App\Anuncio');
        }
}

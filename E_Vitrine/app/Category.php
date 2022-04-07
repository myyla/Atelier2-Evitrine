<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    
    protected $guarded=[];
    
    public function produits(){
        return $this->hasMany('App\Produit');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

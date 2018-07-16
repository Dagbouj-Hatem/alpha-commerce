<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    //
	 protected $fillable = [
        'ref', 'designation', 'prix','fournisseur','qte','remise'
    ];
    

}

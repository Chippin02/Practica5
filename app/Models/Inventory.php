<?php

namespace P\Models;

use Illuminate\Database\Eloquent\Model;
use P\Session;

class Inventory extends Model {

    protected $table = 'inventory';

    //ESTO ES PARA LA CREACIÓN DE UNA OFERTA
    protected $fillable = ['name', 'id_offertype', 'id_producttype', 'description', 'price', 'id_owner', 'addres', 'zipcode', 'state', 'city', 'm2'];

    protected $attributes = ['active'   =>  true];

    public function user() {

        return $this -> belongsTo('P\Models\User');

    }

    public function agreement() {

        return $this -> hasMany('P\Models\Agreement');

    }

    static function allInventory() {

        $inventory = Inventory::all()->toArray();
        return $inventory;

    }

}
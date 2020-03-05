<?php

namespace P\Models;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model {

protected $table = 'agreements';

    //ESTO ES PARA LA CREACIÓN DE UN ACUERDO
    //LAS CLAVES FORÁNEAS NO SON FILLABLES
    //protected $fillable = ['id_seller', 'id_purchaser', 'id_offertype', 'id_inventory', 'datestart', 'datefinish'];
    protected $fillable = ['datestart', 'datefinish'];

    public function user() {

        return $this -> belongsTo('P\Models\User');

    }

    public function inventory() {

        return $this -> belongsTo('P\Models\Inventory');

    }

}
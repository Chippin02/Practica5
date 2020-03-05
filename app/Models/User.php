<?php


namespace P\Models;

use Illuminate\Database\Eloquent\Model;
use P\Session;

class User extends Model {

    protected $table = 'users';

    //ESTO ES PARA LA CREACIÓN DE UN USUARIO
    //LAS CLAVES FORÁNEAS DEBEN PONERSE COMO CAMPOS
    //EN EL MÉTODO, EN CAMBIO, SI HAY QUE IGNORARLO
    protected $fillable = ['username', 'userpass', 'usermail', 'userphone', 'name', 'lastname', 'id_usertype'];

    protected $attributes = ['active'   =>  true];

    public function inventory() {

        return $this -> hasMany('P\Models\Inventory');

    }

    public function agreement() {

        return $this -> hasMany('P\Models\Agreement');

    }

    static function userData ($id = null) {

        if ($id == null) { $id = Session::get('id'); }
        $user = User::where('id', $id) -> get() -> first();
        return $user;

    }

}
<?php


namespace P\Models;

/*Al poner el "AS Capsule" le ponemos el alias*/
use Illuminate\Database\Capsule\Manager as Capsule;

class Database {

    /*Este será quién utilice la "cápsula"*/
    function __construct() {
        /*Primera parte de la conexión*/
        $capsule = new Capsule();
        /*Definimos la conexión*/
        //$capsule -> addConnection($config);
        $capsule -> addConnection([

            'driver'    => DBDRIVER,
            'host'      => DBHOST,
            'database'  => DBNAME,
            'username'  => DBUSER,
            'password'  => DBPASS,
            'charset'   => 'utf8',
            /*el collation es importante usarlo con unicode_ci por trabajar con un estandard internacional que no se
            vería afectado por ñ o acentos*/
            'collation' => 'utf8_unicode_ci',
            /*El prefijo de las tablas, no es necesario*/
            'prefix'    => ''
        ]);
        /*Como usamos una estructura con muchos espacios de nombres debemos hacer que sea GLOBAL*/
        $capsule -> setAsGlobal();
        /*Activamos el eloquent*/
        /*Cada vez que creemos un new database nos creará esta conexión*/
        $capsule -> bootEloquent();
    }
}
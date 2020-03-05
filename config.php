<?php
    //debo crear la base de datos con estos valores
    define('DBDRIVER',  'mysql');
    define('DBHOST',    '127.0.0.1');   //podemos poner localhost en lugar de la ip
    define('DBNAME',    'practica5');
    define('DBUSER',    'practica5');
    define('DBPASS',    'linuxlinux');

    //Esto serviría para darle seguridad a los formularios
    //NO ES NECESARIO AHORA MISMO
/*
    function getToken() {

        $token = md5(uniqid(rand(), true));
//faltan cosas

    }
*/
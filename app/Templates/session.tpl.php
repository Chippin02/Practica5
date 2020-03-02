<?php

    use P\Session;

    if (Session::get('logged')) {

        switch (Session::get('type')) {

            case 'administrador':   include 'aloged.tpl.php'; break;
            case 'comprador':       include 'ploged.tpl.php'; break;
            case 'venedor':         include 'sloged.tpl.php'; break;
            default:                include 'psloged.tpl.php'; break;

        }

    }
    else {

        include 'notloged.tpl.php';

    }

?>
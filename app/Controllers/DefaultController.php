<?php


namespace P\Controllers;

use P\Controller;
use P\Controller\Inventory;

final class DefaultController extends Controller {

    public function __construct($request) {

        parent::__construct($request);

    }

    public function index() {

        $data = ['title'=>'Construccions per a tothom'];
        $this->render($data);

    }

    //function error() { throw new \Exception("[ERROR::]:No existe el método"); }

}
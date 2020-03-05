<?php
    ini_set('display_errors', 'On');

    require __DIR__.'/vendor/autoload.php';

    require 'config.php';

    use P\App;
    use P\Session;

    use P\Models\Database;
    use P\Models\User;
    use P\Models\Inventory;

    use P\Controllers\UserController;
    use P\Controllers\InventoryController;
    use P\Controllers\AgreementController;

    use Illuminate\Support\Manager as Capsule;

    Session::init();    //EQUIVALE A UN SESSION START
    //getToken();

    App::run();



    /*$users = User::all();
    foreach ($users as $user) {
        echo $user -> email.'<br>';
    }*/
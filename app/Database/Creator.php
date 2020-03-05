<?php

require '../../vendor/autoload.php';
require '../../config.php';

new P\Models\Database();

use Illuminate\Database\Capsule\Manager as Capsule;

//PARA INVOCARME ESCRIBIR EN CONSOLA: php /home/linux/projectes/UF3/Practica5/app/Database/Creator.php
//O BIEN MOVERME A LA CARPETA EN CUESTION Y SOLO INDICAR: php Creator.php

/*//TABLA CREADA
Capsule::schema() -> create('usertypes', function ($table) {

    $table -> increments('id') -> unsigned();
    $table -> string('name');
    $table -> timestamps();
    $table -> engine = 'InnoDB';
    $table -> charset = 'utf8';
    $table -> collation = 'utf8_unicode_ci';

});
*/
/*//TABLA CREADA
Capsule::schema() -> create('users', function ($table) {

    $table -> increments('id');
    $table -> string('username') -> unique();
    $table -> string('userpass') -> unique();
    $table -> string('usermail') -> unique();
    $table -> string('userphone') -> unique();
    $table -> string('name');
    $table -> string('lastname');
    $table -> integer('id_usertype') -> unsigned();
    $table -> boolean('active');
    $table -> timestamps();
    $table -> foreign('id_usertype') -> references('id') -> on('usertypes');
    $table -> engine = 'InnoDB';
    $table -> charset = 'utf8';
    $table -> collation = 'utf8_unicode_ci';

});
*/
/*//TABLA CREADA
Capsule::schema() -> create('offertypes', function ($table) {

    $table -> increments('id');
    $table -> string('name');
    $table -> timestamps();
    $table -> engine = 'InnoDB';
    $table -> charset = 'utf8';
    $table -> collation = 'utf8_unicode_ci';

});
*/
/*//TABLA CREADA
Capsule::schema() -> create('producttypes', function ($table) {

    $table -> increments('id');
    $table -> string('name');
    $table -> timestamps();
    $table -> engine = 'InnoDB';
    $table -> charset = 'utf8';
    $table -> collation = 'utf8_unicode_ci';

});
*/
/*//TABLA CREADA
Capsule::schema() -> create('inventory', function ($table) {

    $table -> increments('id');
    $table -> integer('id_offertype') -> unsigned();
    $table -> integer('id_producttype') -> unsigned();
    $table -> longText('description');
    $table -> double('price', 200);
    $table -> integer('id_owner') -> unsigned();
    $table -> string('addres');
    $table -> string('zipcode');
    $table -> string('state');
    $table -> string('city');
    $table -> double('m2');
    $table -> boolean('active');
    $table -> timestamps();
    $table -> foreign('id_offertype') -> references('id') -> on('offertypes');
    $table -> foreign('id_producttype') -> references('id') -> on('producttypes');
    $table -> foreign('id_owner') -> references('id') -> on('users');
    $table -> engine = 'InnoDB';
    $table -> charset = 'utf8';
    $table -> collation = 'utf8_unicode_ci';

});
*/
/*//TABLA CREADA
Capsule::schema() -> create('agreements', function ($table) {

    $table -> integer('id_seller') -> unsigned();
    $table -> integer('id_purchaser') -> unsigned();
    $table -> integer('id_offertype') -> unsigned();
    $table -> integer('id_inventory') -> unsigned();
    $table -> date('datestart', 200);
    $table -> date('datefinish', 15);
    $table -> timestamps();
    $table -> foreign('id_seller') -> references('id') -> on('users');
    $table -> foreign('id_purchaser') -> references('id') -> on('users');
    $table -> foreign('id_offertype') -> references('id') -> on('offertypes');
    $table -> foreign('id_inventory') -> references('id') -> on('inventory');
    $table -> engine = 'InnoDB';
    $table -> charset = 'utf8';
    $table -> collation = 'utf8_unicode_ci';

});
*/

/*TEST Creación de usuarios*/
//$user = UserController::create("admin", password_hash("admin", PASSWORD_BCRYPT), "admin@admin.com", 630826229, "Admin", "Web", 1);
//$user = UserController::create("comprador", password_hash("comprador", PASSWORD_BCRYPT), "comprador@comprador.com", 665916665, "Comprador", "Web", 2);
//$user = UserController::create("venedor", password_hash("venedor", PASSWORD_BCRYPT), "venedor@venedor.com", 626638193, "Venedor", "Web", 3);
//$user = UserController::create("aiobusiness", password_hash("aiobusiness", PASSWORD_BCRYPT), "aiobusiness@aiobusiness.com", 123456789, "Aio", "Web", 4);

/*TEST Creación de ofertas*/
//$inventory = InventoryController::create(1, 1, 'Lorem ipsum de una casa', 300000.00, 6, 'Carrer montflorit n196 Baix', '08850', 'Barcelona', 'Gavà', 100.00);
//$inventory = InventoryController::create(2, 2, 'Lorem ipsum de un pis', 300.00, 4, 'Avda Mil·lenari n19 E2 3o 4a', '08860', 'Barcelona', 'Castelldefels', 120.00);
//$inventory = InventoryController::create(1, 3, 'Lorem ipsum de una habitació', 305000.00, 6, 'Carrer de foc n152', '08840', 'Barcelona', 'Viladecans', 40.00);
//$inventory = InventoryController::create(2, 4, 'Lorem ipsum de un estudi', 400.00, 4, 'Estudis 34', '08840', 'Barcelona', 'Viladecans', 180.00);
//$inventory = InventoryController::create(1, 5, 'Lorem ipsum de un local', 295000.30, 4, 'Rambla de Vayreda n138', '08850', 'Barcelona', 'Gavà', 200.00);
//$inventory = InventoryController::create(2, 6, 'Lorem ipsum de una plaça de pàrking', 200.00, 6, "Alfredo's street", '08860', 'Barcelona', 'Castelldefels', 50.00);

/*TEST Creación de acuerdos*/
//$agreement = AgreementController::create(6, 1, 1, 1, '2020-02-13 20:23:00', null);
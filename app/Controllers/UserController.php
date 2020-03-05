<?php

namespace P\Controllers;

use P\Models\User;
use P\Controller;
use P\Request;
use P\Session;

class UserController extends Controller {

    public function __construct($request) {

        parent::__construct($request);

    }

    public function index () {

        Session::init();
        if (Session::get('logged') == true) { header("Location:/"); }
        else { header("Location:/user/login"); }

    }

    public function logout() {

        Session::destroy();
        header("Location:/");

    }

    public function login () {

        $data = ['title'=>'Connectar-me'];
        $this->render($data, "login");

    }

    public function signup () {

        $data = ['title'=>'Registrar-me'];
        $this->render($data, "signup");

    }

    public function connect () {

        if (!empty($_REQUEST['usuari'] && !empty($_REQUEST['contrasenya']))) {

            //filter_input se usa para evitar injeccion de código
            $usuari = filter_input(INPUT_POST, 'usuari', FILTER_SANITIZE_STRING);
            $contrasenya = filter_input(INPUT_POST, 'contrasenya', FILTER_SANITIZE_STRING);
            $user = User::where('username', $usuari) -> get() -> first();

            if ($user != null && password_verify($contrasenya, $user -> userpass)) {

                Session::init();
                Session::set('logged', true);
                Session::set('id', $user -> id);
                Session::set('name', $user -> name);

                switch ($user -> id_usertype) {
                    case 1: Session::set('type', 'administrador'); break;
                    case 2: Session::set('type', 'comprador'); break;
                    case 3: Session::set('type', 'venedor'); break;
                    case 4: Session::set('type', 'comprador/venedor'); break;
                }
                header('Location:/');

            }
            else {
                $data = ['title'=>'Connectar-me', 'error'=>'Usuari o contrasenya incorrectes'];
                $this->render($data, "login");
            }

        }
        else {

            $data = ['title'=>'Connectar-me', 'error'=>'Ompli el formulari'];
            $this->render($data, "login");

        }
    }

    public function check () {

        if (!empty($_REQUEST['usuari']) && !empty($_REQUEST['contrasenya']) && !empty($_REQUEST['contrasenya2']) && !empty($_REQUEST['nom']) && !empty($_REQUEST['cognoms']) && !empty($_REQUEST['mail']) && !empty($_REQUEST['telefon'])) {

            if ($_REQUEST['contrasenya'] == $_REQUEST['contrasenya2']) {

                $usuari = filter_input(INPUT_POST, 'usuari', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING);
                $telefon = filter_input(INPUT_POST, 'telefon', FILTER_SANITIZE_STRING);

                $user = User::where('username', $usuari)->get()->first();
                $useremail = User::where('usermail', $email)->get()->first();
                $usertelefon = User::where('userphone', $telefon)->get()->first();

                if ($user == null && $useremail == null && $usertelefon == null) {

                    try {
                        $this->create($_REQUEST['usuari'], $_REQUEST['contrasenya'], $_REQUEST['mail'], $_REQUEST['telefon'], $_REQUEST['nom'], $_REQUEST['cognoms'], $_REQUEST['compte']);
                        $user_created = User::where('username', $usuari)->where('usermail', $email)->where('userphone', $telefon)->get()->first();
                        Session::init();
                        Session::set('logged', true);
                        Session::set('id', $user_created -> id);
                        Session::set('name', $_REQUEST['nom']);
                        switch ($_REQUEST['compte']) {
                            case 1:
                                Session::set('type', 'administrador');
                                break;
                            case 2:
                                Session::set('type', 'comprador');
                                break;
                            case 3:
                                Session::set('type', 'venedor');
                                break;
                            case 4:
                                Session::set('type', 'comprador/venedor');
                                break;
                        }
                        header('Location:/');
                    } catch (\Exception $e) {
                        $data = ['title' => 'Registrar-me', 'error' => 'No ha sigut possible crear el compte, torni a intentar-ho més tard'];
                        $this->render($data, "signup");
                    }


                } else {

                    $data = ['title' => 'Registrar-me', 'error' => 'Ja existeix un compte amb les dades introduïdes'];
                    $this->render($data, "signup");

                }

            }
            else {

                $data = ['title'=>'Registrar-me', 'error'=>'Les contrasenyes no coincideixen'];
                $this->render($data, "signup");

            }

        }
        else {

            $data = ['title'=>'Registrar-me', 'error'=>'Ompli el formulari'];
            $this->render($data, "signup");

        }
    }

    //Aquí no deberíamos de poner las claves foráneas como campos que recibe
    public function create ($username, $userpass, $usermail, $userphone, $name, $lastname, $id_usertype) {
        //Aquí dentro, en cambio, la recuperaríamos del objeto en cuestión
        $user = User::create([  'username'      =>  $username,
                                'userpass'      =>  password_hash($userpass, PASSWORD_BCRYPT),
                                'usermail'      =>  $usermail,
                                'userphone'     =>  $userphone,
                                'name'          =>  $name,
                                'lastname'      =>  $lastname,
                                'id_usertype'   =>  $id_usertype,
                                'active'        =>  true
                            ]);

        echo 'User created';

        return $user;

    }



    /*public function signin () {
        if (!empty($_REQUEST[campo1] && lo mismo campo 2)) {

            filter_input se usa para evitar injeccion de código
            $email = filter_input(FILTER_SANITIZE_STRING);
            $user = User::where('email', $email) -> get() -> first();

            if ($user != null && password_verify($passwd_str, $user -> passw)) {
                ASIGNO AL SESSION;
                header('Location:/dashboard');
            }
            else {
                $this -> error("Password or user");
            }

        }
        else {

            $this -> error ("Fill the form");

        }
    }*/

    //public function signup() {

        //if (!empty($_REQUEST[campo1] && lo mismo campo 2)) {

        //filter_input se usa para evitar injeccion de código
            //$email = filter_input(FILTER_SANITIZE_STRING);

            //Si tengo repetir contraseña lo verifico así
            //if (password1 == password2) { passwordhash = password_hash($password, Codificacion (Se recomienda PASSWORD_ARGON2I));
            //TENGA O NO REVISIÓN
            //try {
                //$user = $this->create_user($email, $passwdhash, $phone);
                //header('location:/');
            //} catch (\Exception $e) {
                //$this->error($e->getMessage());
            //} else {
                //"PAssword does not match";
            //}

        //}
       // else {

            //$this -> error ("Fill the form");

        //}

    //}



}
<?php

namespace P\Controllers;

use P\Models\Inventory;
use P\Controller;
use P\Request;
use P\Session;

class InventoryController extends Controller {

    public function __construct($request) {

        parent::__construct($request);

    }

    public static function create ($id_offertype, $id_producttype, $name, $description, $price, $addres, $zipcode, $state, $city, $m2) {

        $id_owner = Session::get('id');

        $inventory = Inventory::create([    'name'              =>  $name,
                                            'id_offertype'      =>  $id_offertype,
                                            'id_producttype'    =>  $id_producttype,
                                            'description'       =>  $description,
                                            'price'             =>  $price,
                                            'id_owner'          =>  $id_owner,
                                            'addres'            =>  $addres,
                                            'zipcode'           =>  $zipcode,
                                            'state'             =>  $state,
                                            'city'              =>  $city,
                                            'm2'                =>  $m2,
                                            'active'            =>  true
                                    ]);

        echo 'Inventory created';

        return $inventory;

    }

    public function my_publications () {

        $data = ['title'=>'Les meves publicacions'];
        $this->render($data, "mypublications");

    }

    public function post () {

        $data = ['title'=>'Publicar oferta'];
        $this->render($data, "post_publication");

    }

    public function published() {

        if (!empty($_REQUEST['oferta']) && !empty($_REQUEST['tipus']) && !empty($_REQUEST['name']) && !empty($_REQUEST['preu']) && !empty($_REQUEST['descripcio']) && !empty($_REQUEST['m2']) && !empty($_REQUEST['direccio']) && !empty($_REQUEST['cp'])&& !empty($_REQUEST['ciutat']) && !empty($_REQUEST['provincia'])) {

            try {

                $this->create($_REQUEST['oferta'], $_REQUEST['tipus'], $_REQUEST['name'], $_REQUEST['descripcio'], $_REQUEST['preu'], $_REQUEST['direccio'], $_REQUEST['cp'], $_REQUEST['provincia'], $_REQUEST['ciutat'], $_REQUEST['m2']);
                header('Location:/');

            } catch (\Exception $e) {

                $data = ['title' => 'Publicar oferta', 'error' => 'Ja existeix una publicació amb les dades introduïdes'];
                $this->render($data, "post_publication");

            }

        }
        else {

            $data = ['title'=>'Publicar oferta', 'error'=>'Ompli el formulari'];
            $this->render($data, "post_publication");

        }

    }

    public static function show_all_publications() {

        $elements = Inventory::allInventory();
        $content = "<div><h3>Publicacions</h3></div><div id='posts'>";;

        foreach ($elements as $element) {

            $dades_propietari = \P\Models\User::userData($element['id_owner']);

            $tipus = self::text_offer_type($element['id_offertype']);
            $producte = self::text_product_type($element['id_producttype']);
            $content.= self::build_content($element, $tipus, $producte, $dades_propietari);

        }

        $content.="</div>";
        return $content;

    }

    public static function get_inventory_with_user() {

        return Inventory::with('user') -> get() -> toArray();
        //return Question::with('User') -> get() -> toJson();

    }

    public static function get_my_publications() {

        $id = Session::get('id');
        return Inventory::where('id_owner', $id)->get()->all();

    }

    public static function show_my_publications() {

        $elements = self::get_my_publications();
        $content = "<div><h3>Les meves publicacions</h3></div><div id='posts'>";

        foreach ($elements as $element) {

            $dades_propietari = \P\Models\User::userData($element['id_owner']);

            $tipus = self::text_offer_type($element['id_offertype']);
            $producte = self::text_product_type($element['id_producttype']);
            $content.= self::build_content($element, $tipus, $producte, $dades_propietari, true);

        }

        $content.="</div>";
        return $content;

    }

    public static function text_offer_type ($value) {

        switch ($value) {

            case 1: return 'Venda'; break;
            case 2: return 'Lloguer'; break;

        }

    }

    public static function text_product_type ($value) {

        switch ($value) {

            case 1: return 'Casa'; break;
            case 2: return 'Pis'; break;
            case 3: return 'Habitació'; break;
            case 4: return 'Estudi'; break;
            case 5: return 'Local'; break;
            case 6: return 'Plaça de parking'; break;

        }

    }

    public static function build_content ($element, $tipus, $producte, $dades_propietari, $boto = null) {

        $content = "<div id='caja_oferta'>
                <table>
                    <tr><th colspan='4' style='display: flex; align-items: center;'><h4>".$element['name']."</h4>";
        if ($boto == true) {
            $content.=" <form method='post' action='/inventory/edit_publication'><input type='hidden' value='".$element['id']."' name='id'><button><i class='fas fa-pencil-alt' alt='editar publicació'></i></button></form>
            <form method='post' action='/inventory/delete_publication'><input type='hidden' value='".$element['id']."' name='id'><button><i class='fas fa-trash-alt' alt='eliminar publicació'></i></button></form>";
        }
        $content.="</th></tr>
                    <tr><td colspan='4'>".$element['created_at']."</td></tr>
                    <tr><td><b>Tipus oferta</b>: </td><td>".$tipus."</td><td><b>Tipus producte</b>: </td><td>".$producte."</td></tr>
                    <tr><th colspan='4'>Descripció</th></tr>
                    <tr><td colspan='4'>".$element['description']."</td></tr>
                    <tr><td><b>Preu</b>: </td><td>".$element['price']."</td><td><b>m2</b>: </td><td>".$element['m2']."</td></tr>
                    <tr><td><b>Provincia</b>: </td><td>".$element['state']."</td><td><b>Ciutat</b>: </td><td>".$element['city']."</td></tr>
                    <tr><td colspan='2'><td><b>CP</b>: </td><td>".$element['zipcode']."</td></tr>
                    <tr><td><b>Direcció</b>: </td><td colspan='3'>".$element['addres']."</td></tr>
                    <tr><td><b>Contacte</b>: </td><td colspan='3'>".$dades_propietari['username']." (".$dades_propietari['usermail'].")</td></tr>
                </table>
            </div>";
        return $content;

    }

    public function edit_publication () {

        $data = ['title'=>'Editar oferta'];
        $this->render($data, "update_publication");

    }

    public static function get_publication_data () {

        $id = Session::get('id');
        $inventory = Inventory::where('id_owner', $id) -> where('id', $_REQUEST['id'])->get()->all();
        return $inventory;

    }

    public static function build_update_form () {

        $id = Session::get('id');
        if (isset($_REQUEST['id_inventory'])) { $inventory = Inventory::where('id_owner', $id) -> where('id', $_REQUEST['id_inventory'])->get()->toArray(); }
        else { $inventory = Inventory::where('id_owner', $id) -> where('id', $_REQUEST['id'])->get()->toArray(); }
        $form = "<form action='/inventory/update' method='post'>
                    <input type='hidden' value='";
                    if (isset($_REQUEST['id_inventory'])) { $form.=$_REQUEST['id_inventory']; }
                    else { $form.=$_REQUEST['id']; } $form.="' name='id_inventory'>
                    <table style='border-spacing: 5px;'>
                        <tr>
                            <td style='text-align: right;'>Tipus d'oferta </td>
                            <td><select name='oferta' id='oferta'>
                                    <option value='1'"; if (!empty($_REQUEST['oferta']) && $_REQUEST['oferta'] == 1) { $form.="selected"; } else if($inventory[0]['id_offertype'] == 1) { $form.="selected"; } $form.=">Venda</option>
                                    <option value='2'"; if (!empty($_REQUEST['oferta']) && $_REQUEST['oferta'] == 2) { $form.="selected"; } else if($inventory[0]['id_offertype'] == 2) { $form.="selected"; } $form.=">Lloguer</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td style='text-align: right;'>Tipus de vivenda </td>
                            <td><select name='tipus' id='tipus'>
                                    <option value='1'"; if (!empty($_REQUEST['tipus']) && $_REQUEST['tipus'] == 1) { $form.="selected"; } else if($inventory[0]['id_producttype'] == 1) { $form.="selected"; } $form.=">Casa</option>
                                    <option value='2'"; if (!empty($_REQUEST['tipus']) && $_REQUEST['tipus'] == 2) { $form.="selected"; } else if($inventory[0]['id_producttype'] == 2) { $form.="selected"; } $form.=">Pis</option>
                                    <option value='3'"; if (!empty($_REQUEST['tipus']) && $_REQUEST['tipus'] == 3) { $form.="selected"; } else if($inventory[0]['id_producttype'] == 3) { $form.="selected"; } $form.=">Habitació</option>
                                    <option value='4'"; if (!empty($_REQUEST['tipus']) && $_REQUEST['tipus'] == 4) { $form.="selected"; } else if($inventory[0]['id_producttype'] == 4) { $form.="selected"; } $form.=">Estudi</option>
                                    <option value='5'"; if (!empty($_REQUEST['tipus']) && $_REQUEST['tipus'] == 5) { $form.="selected"; } else if($inventory[0]['id_producttype'] == 5) { $form.="selected"; } $form.=">Local</option>
                                    <option value='6'"; if (!empty($_REQUEST['tipus']) && $_REQUEST['tipus'] == 6) { $form.="selected"; } else if($inventory[0]['id_producttype'] == 6) { $form.="selected"; } $form.=">Plaça de parking</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style='text-align: right;'><label for='name'>Nom </label></td>
                            <td><input type='text' name='name' id='name' placeholder='Nom de la publicació'";
                            if(!empty($_REQUEST['name'])) { $form.="value='".$_REQUEST['name']."' "; }
                            else if($inventory[0]['name']) { $form.="value='".$inventory[0]['name']."' "; }
                        $form.="required></td>
                        </tr>
                        <tr>
                            <td style='text-align: right;'><label for='preu'>Preu </label></td>
                            <td><input type='number' min='0.00' step='0.01' style='height: 20px;' name='preu' id='preu'";
                            if(!empty($_REQUEST['preu'])) { $form.="value='".$_REQUEST['preu']."' "; }
                            else if($inventory[0]['price']) { $form.="value='".$inventory[0]['price']."' "; }
                        $form.="placeholder='Preu de la oferta' required></td>
                        </tr>
                        <tr>
                            <td style='text-align: right;'><label for='descripcio'>Text descriptiu </label></td>
                            <td><textarea name='descripcio' id='descripcio' rows='6' cols='50' placeholder='Descripció del producte' required>";
                            if(!empty($_REQUEST['descripcio'])) { $form.=$_REQUEST['descripcio']; }
                            else if($inventory[0]['description']) { $form.=$inventory[0]['description']; }
                        $form.="</textarea></td>
                        </tr>
                        <tr>
                            <td style='text-align: right;'><label for='m2'>M2 </label></td>
                            <td><input type='number' min='0.00' step='0.01' style='height: 20px;' name='m2' id='m2'";
                            if(!empty($_REQUEST['m2'])) { $form.="value='".$_REQUEST['m2']."' "; }
                            else if($inventory[0]['m2']) { $form.="value='".$inventory[0]['m2']."' "; }
                        $form.="placeholder='Metres cuadrats de la vivenda'></td>
                        </tr>
                        <tr>
                            <td style='text-align: right;'><label for='direccio'>Direcció </label></td>
                            <td><input type='text' name='direccio' id='direccio' placeholder='Direcció de la vivenda'";
                            if(!empty($_REQUEST['direccio'])) { $form.="value='".$_REQUEST['direccio']."' "; }
                            else if($inventory[0]['addres']) { $form.="value='".$inventory[0]['addres']."' "; }
                        $form.="required></td>
                        </tr>
                        <tr>
                            <td style='text-align: right;'><label for='cp'>Codi Postal </label></td>
                            <td><input type='text' name='cp' id='cp' placeholder='Codi Postal de la vivenda'";
                            if(!empty($_REQUEST['cp'])) { $form.="value='".$_REQUEST['cp']."' "; }
                            else if($inventory[0]['zipcode']) { $form.="value='".$inventory[0]['zipcode']."' "; }
                        $form.="required></td>
                        </tr>
                        <tr>
                            <td style='text-align: right;'><label for='ciutat'>Ciutat </label></td>
                            <td><input type='text' name='ciutat' id='ciutat'";
                            if(!empty($_REQUEST['ciutat'])) { $form.="value='".$_REQUEST['ciutat']."' "; }
                            else if($inventory[0]['city']) { $form.="value='".$inventory[0]['city']."' "; }
                        $form.="placeholder='Ciutat de la vivenda'></td>
                        </tr>
                        <tr>
                            <td style='text-align: right;'><label for='provincia'>Provincia </label></td>
                            <td><input type='text' name='provincia' id='provincia' placeholder='Provincia de la vivenda'";
                            if(!empty($_REQUEST['provincia'])) { $form.="value='".$_REQUEST['provincia']."' "; }
                            else if($inventory[0]['state']) { $form.="value='".$inventory[0]['state']."' "; }
                        $form.="required></td>
                        </tr>
                        <tr>
                            <td colspan='2' style='text-align: center;'><input type='submit' id='editar' value='Editar oferta' name='editar'></td>
                        </tr>
                    </table>
                </form>";
        return $form;

    }

    public function update() {

        if (!empty($_REQUEST['oferta']) && !empty($_REQUEST['tipus']) && !empty($_REQUEST['name']) && !empty($_REQUEST['preu']) && !empty($_REQUEST['descripcio']) && !empty($_REQUEST['m2'])
            && !empty($_REQUEST['direccio']) && !empty($_REQUEST['cp']) && !empty($_REQUEST['ciutat']) && !empty($_REQUEST['provincia'])) {

            try {

                Inventory::find($_REQUEST['id_inventory'])
                    ->update(['name' => $_REQUEST['name'], 'id_offertype' => $_REQUEST['oferta'], 'id_producttype' => $_REQUEST['tipus'], 'description' => $_REQUEST['descripcio'],
                        'price' => $_REQUEST['preu'], 'address' => $_REQUEST['direccio'], 'zipcode' => $_REQUEST['cp'], 'state' => $_REQUEST['provincia'], 'city' => $_REQUEST['ciutat'],
                        'm2' => $_REQUEST['m2']]);

                header('Location:/inventory/my_publications');

            } catch (\Exception $e) {

                    $data = ['title' => 'Publicar oferta', 'error' => 'Ja existeix una publicació amb les dades introduïdes'];
                    $this->render($data, "update_publication");

            }

        }
        else {

            $data = ['title'=>'Editar oferta', 'error'=>'Ompli el formulari'];
            $this->render($data, "update_publication");

        }

    }

    public function delete_publication () {

        try {

            Inventory::destroy($_REQUEST['id']);
            header('Location:/inventory/my_publications');

        } catch (\Exception $e) {

            $data = ['title' => 'Les meves publicacions', 'error' => 'NO ha sigut possible eliminar la publicació'];
            $this->render($data, "mypublications");


        }

    }

    public function filter () {

        echo "En construcción";
        /*
        if($_REQUEST['id_offerttype'] != 0 || $_REQUEST['id_producttype'] != 0 || !empty($_REQUEST['name']) || !empty($_REQUEST['price']) || !empty($_REQUEST['m2'])
            || !empty($_REQUEST['addres']) || !empty($_REQUEST['zipcode']) || !empty($_REQUEST['city']) || !empty($_REQUEST['state'])) {

            $sentencia = "";
            foreach ($_REQUEST as $key => $value) {

                    if ($key != "Filtrar" && $key != "origen" && $key != "price" && $key != "m2") {

                        if (($key == 'id_offerttype' || $key == 'id_producttype') && $value != 0) { $sentencia.= '->where('.$key.', '.$value.')'; }
                        else if ($key == 'filtre_price' || $key == 'filtre_m2') {

                            $name = substr($key, 7, strlen($key));
                            if (!empty($_REQUEST[$name])) {

                                $sentencia.= '->where('.$name.', '.$value.', '.$_REQUEST[$name].')';

                            }


                        }
                        else if (($key == 'name' || $key == 'addres') && $value != 0) { $sentencia.= '->where('.$key.', like, %'.$value.'%)'; }
                        else if (($key != 'price' || $key != 'm2') && $value != 0) { $sentencia.= '->where('.$key.', '.$value.')'; }

                    }

            }

            if (strlen($sentencia) != 0) {

                $sentencia = substr($sentencia, 2, strlen($sentencia));
                $inventory = Inventory::print "$sentencia";->get()->all();
                var_dump($inventory);

            }



        }
        else {

            echo "NO HA INDICADO NINGUNA CONDICIÓN";

        }
        */

    }

}
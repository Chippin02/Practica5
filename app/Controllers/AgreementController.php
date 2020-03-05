<?php

namespace P\Controllers;

use P\Models\Agreement;

class AgreementController {



    public static function create($id_seller, $id_purchaser, $id_offertype, $id_inventory, $datestart, $datefinish) {

        $agreement = Agreement::create(['id_seller' => $id_seller,
            //'id_seller' => $user -> 'id'
            'id_purchaser' => $id_purchaser,
            'id_offertype' => $id_offertype,
            'id_inventory' => $id_inventory,
            'datestart' => $datestart,
            'date_finish' => $datefinish
        ]);

        echo 'Agreement created';

        return $agreement;

    }

    /*  LAS CLAVES NO FILLABLES NO SE PONEN EN EL CREATE
        public static function create($datestart, $datefinish) {
        $agreement = Agreement::create([    'id_seller' => $user -> 'id'
                                            'id_purchaser' => $user -> 'id'
                                            'id_offertype' => $inventory -> 'id_offertype'
                                            'id_inventory' => $inventory -> 'id'
                                            'datestart' => $datestart,
                                            'date_finish' => $datefinish
        ]);
    }*/

}
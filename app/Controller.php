<?php


namespace P;


abstract class Controller implements View {

    protected $request;

    function __construct($request) { $this->request = $request; }

    function error($string) {

        $this->render(['error' => $string], 'error');
        //throw new \Exception("[ERROR::]:No existe el método");

    }

    public function render(array $dataview = null, string $template = null) {

        if ($dataview) {

            extract($dataview);

        }

        if ($template != "") {

            include 'Templates/' . $template . '.tpl.php';

        }

        else {

            include 'Templates/' . $this->request->getController() . '.tpl.php';

        }

    }

    function getDB() {

        $db = DB::singleton();
        return $db;

    }

    protected function query($db, $sql, $params = null) {
        try {
            $stmt = $db->prepare($sql);
            if ($params) { $res = $stmt->execute($params); }
            else { $res = $stmt->execute(); }
            //AQUÍ DEBERÍAMOS USAR $RES PARA HACER UN RETURN DE LA SENTENCIA O BIEN UN ERROR;
            return $stmt;
        }catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function row_extract_one($stmt) {
        $rows = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $rows;
    }
    protected function row_extracts($stmt) {
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }

}
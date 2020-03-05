<?php


namespace P;


use P\Models\Database;

class App {

    //public $routes=[];

    static function run() {

        //Damos acceso a ELOQUENT
        new Database();

        $routes = self::getRoutes();

        $request = new Request();
        $controller = $request->getController();
        $action = $request->getAction();

        try {
            if (in_array($controller, $routes)) {
                $nameController = '\\P\Controllers\\' . ucfirst($controller). 'Controller';
                $objCont = new $nameController($request);
                if (is_callable([$objCont, $action])) {
                    call_user_func([$objCont, $action]);
                } else {
                    call_user_func([$objCont, 'error']);
                }
            }
            else {
                throw new \Exception("[ERROR]: Ruta no definida");
            }
        }
        catch (\Exception $e) {
            echo $e->getMessage();

        }

    }
    /*
     *  EXTRACTS controller && method
     *  @return array
     */
    static function getRoutes():Array {
        $dir = __DIR__.'/Controllers';
        $handle = opendir($dir);
        while (false != ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $routes[] = strtolower(substr($entry, 0, -14));
            }
        }
        return $routes;
    }

}
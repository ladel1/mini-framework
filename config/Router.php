<?php
namespace Config;

use Vendor\Codingx\ReadFile;
use Vendor\Codingx\Redirect;
use Vendor\Codingx\Request;
use Vendor\Exceptions\NotFoundException;

class Router{
    use Redirect;

    public static function guardian($routes,$page){
        if(isset($routes[$page][2]) && $routes[$page][2]==="guard"){
            $user = Session::getInstance()->get("user");
            if(!$user){
                Router::redirect("login");
            }
        }
    }

    public static function route(){          
        $routes=ReadFile::readJson(ROUTES);
        // https://stackoverflow.com/questions/27116940/dependency-injection-on-dynamically-created-objects
        // $request = new Request;
        // var_dump($request->get("qsdfsqdf"));
        // die;
        $page = (isset($_GET["page"]))? $_GET["page"] : "";
        self::guardian($routes,$page);
        if(isset($routes[$page])){
            $controlerName=$routes[$page][0];
            $methodName=$routes[$page][1];                
            $instanceController = new $controlerName();
            return $instanceController->$methodName($_REQUEST);
        }else{
            throw new NotFoundException();
        }
    }

}
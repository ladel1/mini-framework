<?php
namespace Config;

use Helpers\ReadFile;
use Helpers\Redirect;
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
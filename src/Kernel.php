<?php 
namespace App;
use Config\Router;
use Exception;
use Helpers\LoadConfig;
use Vendor\Exceptions\AbstractException;

class Kernel{

    public static function boot(){
        // load config
        LoadConfig::load();
        try{
            $datas = Router::route();
            extract($datas);
            $layoutFile = "src/view/$layout.php";
            if(file_exists($layoutFile)){
                require_once "src/view/$layout.php";
            }else{
                throw new Exception("Layout not defined <extends>?</extends>");
            }
        }catch(AbstractException $e){          
            echo $e->load();
        }
    }

}
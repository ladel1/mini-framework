<?php 
namespace App;
use Config\Router;
use Helpers\LoadConfig;
use Vendor\Exceptions\AbstractException;

class Kernel{

    public static function boot(){
        // load config
        LoadConfig::load();
        try{
            $datas = Router::route();
            extract($datas);
            require_once "src/view/base.php";
        }catch(AbstractException $e){
          
            echo $e->load();
        }
    }

}
<?php 
namespace App\Controller;
use Config\Session;
use Helpers\Exctractable;

abstract class AbstractController {
    use Exctractable;
    
    private $session;

    public function __construct()
    {
        $this->session = Session::getInstance();
    }

    protected function renderView($templatename,$params=[],$pageTitle=""){
        ob_start();
        extract($params);
        require_once "src/view/$templatename.php";
        $html = ob_get_contents();
        ob_clean();
        $datas = [
            "title"=>$pageTitle,
            "css"=>$this->getTagContent($html,"css"),
            "js"=>$this->getTagContent($html,"js"),
            "layout"=>$this->getTagContent($html,"extends"),
            "content"=>$html
        ];
        return $datas;
    }


    protected function redirect($link){
        header("Location:$link");
    }

    /**
     * Get the value of session
     */
    protected function session()
    {
        return $this->session;
    }
}
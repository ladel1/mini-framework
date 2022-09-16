<?php 
namespace Helpers;

trait Redirect{

    protected function redirect($link){
        header("Location:".CONTEXT_PATH."$link");
        exit();
    }

}
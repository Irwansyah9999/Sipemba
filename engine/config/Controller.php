<?php

abstract class Controller{
    protected $event = array();

    abstract function actionAvailable();


    function addAction(string $key,string $action){
        $this->event[$key] = $action;

    }

    function getAction(){
        return $this->event;
    }
}
?>
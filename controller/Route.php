<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 14-6-2017
 * Time: 09:42
 */

class Route extends Controller
{
    function __construct()
    {
        $url = $_SERVER['REQUEST_URI'];
        $packets = explode('/',$url);
        $this->determineDestination($packets);
    }

    public function determineDestination($packets='')
    {
        $params = array();
        $get = $this->Sql()->Read("SELECT `pagetag`, `controller` FROM pages WHERE `pagetag`= '".$packets[2]."';");
        if(!isset($get[0])) {
            $this->sendToDestination('ErrorController', 'index', array('404'));
        } else {
            $classname = $get[0]['controller'];
            if (isset($packets[3]) && $packets[3] != '') { $method = $packets[3]; } else {$method = 'index';};
            for($i=4;$i<count($packets);$i++) {array_push($params, $packets[$i]);}

//            $params = array_slice($packets, 4);
            $this->sendToDestination($classname, $method, $params);
        }
    }

    public function sendToDestination($controller, $method, $params)
    {
//        $class = $controller.'.php';
        require_once($controller.'.php');
        $obj = new $controller;
        die(call_user_method($method, $obj, $params));
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}
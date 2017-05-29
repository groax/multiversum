<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 25-5-2017
 * Time: 01:09
 */

class Controller {
    public $view;

    function __construct() {

    }

    public function Sql() {
        require_once('web.php');
        return new DbHandler(DB_HOST,DB_DATABASE,DB_USER,DB_PASS);
    }

    public function Page($content) {
        return include("../view/".$content.".php");
    }
}
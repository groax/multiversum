<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 25-5-2017
 * Time: 01:09
 */

class Controller {
    public $view;

    function __construct()
    {
    }

    public function html()
    {
        return new HtmlHandler();
    }

    public function Sql()
    {
        require_once('./model/web.php');
        return new DbHandler(DB_HOST,DB_DATABASE,DB_USER,DB_PASS);
    }

    public function Navbar()
    {
        return $this->Sql()->Read("SELECT * FROM pages where pageshow = 1;");
    }

    public function Page($content)
    {
        return include("../view/".$content.".php");
    }
}
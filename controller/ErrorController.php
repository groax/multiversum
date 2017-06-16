<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 14-6-2017
 * Time: 10:58
 */

class ErrorController extends Controller
{
    public function index($error)
    {
        $content = './view/'.$error[0].'.php';
        $title = $error[0];
        $nav = Controller::Navbar();
        include('./view/layout.php');
    }
}
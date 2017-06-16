<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 15-6-2017
 * Time: 18:09
 */

class DetailsController extends Controller
{

    function __construct()
    {
    }

    public function show($id)
    {
        $content = './view/details.php';
        $title = 'details';
        $nav = Controller::Navbar();
        $data = $data = Controller::html()->title('home', '12', true);
        include('./view/layout.php');
    }
}
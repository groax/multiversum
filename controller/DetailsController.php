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
        $sql = Controller::sql()->Read('select * from articles where id='.$id[0].';');
        $content = Controller::View('Details/show');
        $title = $sql[0]['title'];
        $nav = Controller::Navbar();
        $data = Controller::html()->title($sql[0]['title'], '12', 2, true, false);
        $data .= Controller::html()->details($id[0]);
        include( Controller::View('layout'));
    }
}
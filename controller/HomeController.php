<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 14-6-2017
 * Time: 10:55
 */

class HomeController extends Controller
{
   public $html;

    function __construct()
    {
        $this->html = new HtmlHandler();
    }

    public function index()
    {
        $content = Controller::View('Home/index');
        $title = 'home';
        $nav = Controller::Navbar();
        $data = Controller::html()->title('home', '12', 2, true, false);
        $data .= Controller::html()->content("
            SELECT pages.id, title, body, 
            size FROM pages 
            JOIN content 
            ON pages.id=content.pages_id 
            WHERE pagetag = 'home'");
        $data .= $this->html->article();


        include(Controller::View('layout'));
    }

    public function edit($id)
    {
    }
}
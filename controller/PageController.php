<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 25-5-2017
 * Time: 01:16
 */

class PageController extends Controller
{
    private $_uri = array();
    public $page;
    private $dB;

    function __construct()
    {
        $this->dB = Controller::Sql();

    }

    public function add($uri)
    {
        $this->_uri[] = trim($uri, '/');
    }

    public function route()
    {
        $uriGetParam = isset($_GET['uri']) ? $_GET['uri'] : '/';
        if ($uriGetParam == '/') {
            $content = './view/home.php';
            $title = 'home';
            $this->page = $uriGetParam;
            $pageContent = $this->Makepage($title);
            $pageArticles = $this->MakeArticle('ORDER BY created_at DESC LIMIT 0 ,2');
        } elseif ($uriGetParam == 'home') {
            $content = './view/home.php';
            $title = 'home';
            $this->page = $uriGetParam;
            $pageContent = $this->Makepage($title);
            $pageArticles = $this->MakeArticle('ORDER BY created_at DESC LIMIT 0 ,2');
        } else {
            foreach ($this->_uri as $key => $value) {
                if (preg_match("#^$value$#", $uriGetParam)) {
                    $content = './view/' . $value . '.php';
                    $title = ucfirst($value);
                    $this->page = $uriGetParam;
                    $pageContent = $this->Makepage($uriGetParam);
                    $pageArticles = $this->MakeArticle('');
                }
            }
        }
        $nav = $this->Navbar();
        @include('./view/layout.php');
    }

    public function Navbar()
    {
        return $this->dB->Read("SELECT * FROM pages where pageshow = 1;");
    }

    public function Makepage($page)
    {
        $data = '';
        $this->page = $page;
        $sql = $this->dB->Read("
            SELECT pages.id, title, body, 
            size FROM pages 
            JOIN content 
            ON pages.id=content.pages_id 
            WHERE pagetag ='" . $page . "';");

//        $data = '<div class="col-sm-12 text-center"><h3>'.ucfirst($page).'</h3><hr></div>';

        foreach ($sql as $r) {
            $data .= '<div class="col-sm-' . $r['size'] . ' body">';
            if ($r['title'])
                $data .= '<h3>' . $r['title'] . '</h3>';
            if ($r['body'])
                $data .= '<p>' . $r['body'] . '</p>';
            $data .= '</div>';
        }
        $data .= '<div class="col-sm-12"></div>';
        return $data;
    }

    public function MakeArticle($order)
    {
        $data = '';
        $sql = $this->dB->Read("SELECT * FROM articles " . $order . ";");

        $data .= '<div class="col-sm-12"></div>';

        foreach ($sql as $r) {
            $data .= '<div class="col-sm-3 articles">';
            $data .= '<div class="panel panel-default">';
            if ($r['image'])
                $data .= '<div class="panel-heading"><img class="img-responsive" src="' . $r['image'] . '" alt="' . $r['title'] . '"></div>';
            $data .= '<div class="panel-body">';
            if ($r['title'] and $r['price'])
                $data .= '<h4><span class="pull-left">' . $r['title'] . '</span><span class="pull-right">&euro;' . $r['price'] . '</span></h4>';
            $data .= '</div>';
            if ($r['body'])
                $data .= '<div class="panel-body"><p>' . $r['body'] . '</p></div>';
            $data .= '<a class="btn btn-primary" onclick="Add(' . $r['id'] . ')">Bestellen</a>';
            $data .= '<a href="details?id='.$r['id'].'." class="btn btn-primary pull-right">Lees meer</a>';
            $data .= '</div></div>';
        }
        return $data;
    }

    public function getArticle($id) {
        session_start();
        $data= '';
        $cart = $this->dB->Read('SELECT * FROM articles WHERE id=' . $id);
        foreach ($cart as $r) {
            if ($r['image'])
                $data .= '<div class="col-sm-4"><img class="img-responsive" src="' . $r['image'] . '" alt="' . $r['title'] . '"></div>';
            $data .= '<div class="col-sm-6">';
            $data .= '<h3>'.$r['title'].'</h3>';
            $data .= '<p>'.$r['body'].'</p>';
            $data .= '<p>&euro;'.str_replace('.', ',', $r['price']).'</p>';



        }
        $data .= '<a class="btn btn-primary" onclick="Add(' . $r['id'] . ')">Bestellen</a>';
//        $data .= '<a href="details?id='.$r['id'].'." class="btn btn-primary pull-right">Lees meer</a>';
        $data .= '</div>';

        return $data;

    }
}

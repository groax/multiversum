<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 14-6-2017
 * Time: 09:21
 */

class HtmlHandler extends Controller {

    function __construct()
    {

    }

    public function title($name, $size=12, $underline=false)
    {
        $line = '';
        if($underline==true) $line = '<hr>';
        return '<div class="w3-col s'.$size.'"><h3>'.ucfirst($name).'</h3>'.$line.'</div>';
    }

    public function content($sql)
    {
        $data = '';
        $content = Controller::Sql()->Read($sql);

        foreach ($content as $r) {
            $data .= '<div class="w3-col s' . $r['size'] . ' body">';
            if ($r['title'])
                $data .= '<h3>' . $r['title'] . '</h3>';
            if ($r['body'])
                $data .= '<p>' . $r['body'] . '</p>';
            $data .= '</div>';
        }
        $data .= '<div class="w3-col s12"></div>';
        return $data;
    }

    public function article($order='')
    {
        $data = '';
        $sql = $this->Sql()->Read("SELECT * FROM articles " . $order . ";");

        $data .= '<div class="w3-col s12"></div>';

        foreach ($sql as $r) {
            $data .= '<div class="w3-col l3 s6">';
            $data .= '<div class="w3-container">';
            $data .= '<div class="w3-display-container w3-opacity-min w3-hover-opacity-off">';
            $data .= '<p><b>'.$r['title'].'</b></p>';
            if ($r['image'])
                $data .= '<img class="loading" src="' . $r['image'] . '" alt="' . $r['title'] . '" style="width:100%">';
//            $data .= '<div class="w3-display-bottomright w3-display-hover w3-large">';
//            $data .= '<a onclick="Add(' . $r['id'] . ')" class="w3-white w3-animate-opacity w3-btn w3-margin w3-round" title="Shopping Cart"><i class="fa fa-shopping-cart w3-text-grey"></i></a>';
//            $data .= '</div>';

            $data .= '<div class="w3-display-middle  w3-display-hover">';
            $data .= '<a href="details/show/'.$r['id'].'" class="w3-green w3-animate-opacity w3-btn w3-round">Zie meer</a>';
            $data .= '</div>';
            $data .= '<p>&euro;'.str_replace('.', ',', $r['price']).'</p>';
            $data .= '</div></div></div>';
        }
        return $data;
    }

    public function slide($sql)
    {

    }

    public function img($link)
    {
        return '<img class="loading" src="'.$link.'">';
    }
}
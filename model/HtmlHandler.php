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
        $sql = Controller::sql()->Read("SELECT * FROM articles " . $order . ";");

        $data .= '<div class="w3-col s12"></div>';

        foreach ($sql as $r) {
            $data .= '<div class="w3-col l2 s6">';
            $data .= '<div class="w3-container">';
            $data .= '<p><b>'.$r['title'].'</b></p>';
            $data .= '<div class="w3-display-container w3-opacity-min w3-hover-opacity-off">';
            if ($r['image'])
                $data .= '<img class="loading" src="' . $r['image'] . '" alt="' . $r['title'] . '" style="width:100%">';
//            $data .= '<div class="w3-display-bottomright w3-display-hover w3-large">';
//            $data .= '<a onclick="Add(' . $r['id'] . ')" class="w3-white w3-animate-opacity w3-btn w3-margin w3-round" title="Shopping Cart"><i class="fa fa-shopping-cart w3-text-grey"></i></a>';
//            $data .= '</div>';

            $data .= '<div class="w3-display-middle  w3-display-hover">';
            $data .= '<a href="details/show/'.$r['id'].'" class="w3-green w3-animate-opacity w3-btn w3-round">Zie meer</a>';
            $data .= '</div></div>';
            $data .= '<p>&euro;'.str_replace('.', ',', $r['price']).'</p>';
            $data .= '</div></div>';
        }
        return $data;
    }

    public function details($id)
    {
        $data = '';

        $img = 'SELECT * FROM articles 
            JOIN articles_has_img 
            ON articles.id=articles_has_img.articles_id
            JOIN img 
            ON articles_has_img.img_id=img.id
            WHERE articles.id = '.$id.';';

        $detail = Controller::sql()->Read('select * from articlesdetails
	join articles 
    on articlesdetails.articles_id=articles.id
    where articles_id = '.$id.';');

        $data .= '<div class="w3-col s6">';
        $data .= '<p>'.$detail[0]['body'].'</p>';
        $data .= '</div>';
        $data .= '<div class="w3-col s6">';
        $data .= $this->imgCard($img);
        $data .= '</div>';
        $data .= '';
//        $data .= '';
//        $data .= '';
//        $data .= '';
//        $data .= '';
        $data .= '</div>';


        return $data;
    }

    public function imgCard($sql)
    {
        $data = '';
        $img = Controller::sql()->Read($sql);

        foreach ($img as $m)
        {
            $data .= '<div class="w3-third" style="padding-left: 10px;">';
            $data .= '<div class="w3-card-2">';
            $data .= '<img src="'.$m['link'].'" style="width: 100%;">';
            $data .= '</div></div>';
        }
        return $data;
    }

    public function slide($sql)
    {
        $data = '';
        $i=1;
        $slides = Controller::sql()->Read($sql);

        $data .= '<div class="w3-content w3-display-container" style="max-width:800px;">';
        foreach ($slides as $slide)
        {
            $data .= '<img class="slides " src="'.$slide['link'].'" style="width:100%;">';
        }

        $data .= '<div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">';
        $data .= '<div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>';
        $data .= '<div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>';
        foreach ($slides as $slide)
        {
            $data .= '<span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv('.$i.')"></span>';
            $i++;
        }

        $data .= '</div></div>';

        return $data;
    }

    public function img($link)
    {
        return '<img class="loading" src="'.$link.'">';
    }
}
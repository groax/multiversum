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

    public function title($name='title', $size=12, $textSize=1, $underline=false, $bold=false)
    {
        $line = '';
        if($underline==true) $line = '<hr>';
        if($bold==true) $bold = '<b>'; $boldClose = '</b>';
        return '<div class="col-sm-'.$size.'"><h'.$textSize.'>'.$bold.ucfirst($name).$boldClose.'</h'.$textSize.'>'.$line.'</div>';
    }

    public function content($sql)
    {
        $data = '';
        $content = Controller::Sql()->Read($sql);

        foreach ($content as $r) {
            $data .= '<div class="col-sm-' . $r['size'] . ' body">';
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
        $amount = 1;

        $img = 'select * from articles 
            join articles_has_img 
            on articles.id=articles_has_img.articles_id
            join img 
            on articles_has_img.img_id=img.id
            where articles.id = '.$id.';';

        $detail = Controller::sql()->Read('select articles.price, articles.quantum, platform.platform, resolutie.resolutie, display, purview, hertz, functions, connections, body, title from articlesdetails
            join articles 
            on articlesdetails.articles_id=articles.id
            
            join platform
            on articlesdetails.platform_id=platform.id
            
            join resolutie
            on articlesdetails.resolutie_id=resolutie.id    
            
            where articles_id ='.$id.';');

        if($_SESSION['cart_item'][$detail[0]['title']]) {
            $amount = $_SESSION['cart_item'][$detail[0]['title']]['amount'];
        }

        $data .= '<div class="col-sm-6">';
        $data .= $this->slide($img);
        $data .= '</div>';

        $data .= $this->title('Beschrijving', '6', 3, false, true);

        $data .= '<div class="col-sm-6">';
        $data .= '<p>'.$detail[0]['body'].'</p>';
        $data .= '<hr><h3>Bestellen</h3>';
        $data .= '<label>Hoeveelheid</label><input class="w3-input" id="amount" type="number" min="1"  max="'.$detail[0]['quantum'].'" value="'.$amount.'">';
        $data .=  '<a onclick="add('.$id.')" class="w3-button w3-teal">In winkelwagen</a>';
        $data .= '</div>';

        $data .= $this->title('Specificaties ', '12', 3, false, true);

        $data .= '<div class="col-sm-6">';
        $data .=  $this->articleTable($detail);
        $data .= '</div>';

        $data .= '<div class="col-sm-6"><h3>Bestellen</h3>';
        $data .= '<label>Hoeveelheid</label><input class="w3-input" id="amount" type="number" min="1"  max="'.$detail[0]['quantum'].'" value="'.$amount.'">';
        $data .=  '<a onclick="add('.$id.')" class="w3-button w3-teal">In winkelwagen</a>';
        $data .= '</div>';

//        $data .= '<div class="w3-col s6">';
//        $data .= '<p>'.$detail[0]['body'].'</p>';
//        $data .= '</div>';
//        $data .= '<div class="w3-col s6">';
//        $data .= $this->imgCard($img);
//        $data .= '</div>';

//        $data .= '';
//        $data .= '';
//        $data .= '';
//        $data .= '';
//        $data .= '';
//        $data .= '</div>';
        
        return $data;
    }

    public function imgCard($sql)
    {
        $data = '';
        $img = Controller::sql()->Read($sql);

        foreach ($img as $m)
        {
            $data .= '<div class="col-sm-3" style="padding-left: 10px;">';
            $data .= '<div class="w3-card-2">';
            $data .= '<img src="'.$m['link'].'" style="width: 100%;">';
            $data .= '</div></div>';
        }
        return $data;
    }

    public function articleTable($tables)
    {
        $data = '';
//        $tables = Controller::sql()->Read($sql);
        $data .= '<table class="w3-table w3-hoverable w3-bordered">';

        $data .= '<tr><th>Prijs</th><td>&euro;'.$tables[0]['price'].'</td></tr>';
        $data .= '<tr><th>Beschrikbaar</th><td>'.$tables[0]['quantum'].'</td></tr>';
        $data .= '<tr><th>Geschikt voor</th><td>'.$tables[0]['platform'].'</td></tr>';
        $data .= '<tr><th>Functies</th><td>'.$tables[0]['functions'].'</td></tr>';
        $data .= '<tr><th>Aansluitingen VR-bril</th><td>'.$tables[0]['connections'].'</td></tr>';
        $data .= '<tr><th>Resolutie</th><td>'.$tables[0]['resolutie'].'</td></tr>';
        if($tables[0]['display'] == 1) { $display = '&#10003;'; } else { $display = '&#10005;'; }
        $data .= '<tr><th>Eigen display</th><td>'.$display.'</td></tr>';
        $data .= '<tr><th>Gezichtsveld</th><td>'.$tables[0]['purview'].'°</td></tr>';
//        $data .= '<tr><th>Prijs</th><td>'.$tables[0]['price'].'</td></tr>';

        $data .= '</table>';

        return $data;
    }

    public function slide($sql)
    {
        $data = '';
        $i=1;
        $slides = Controller::sql()->Read($sql);

        $data .= '<div class="w3-content w3-display-container" onclick="stopTimer()" style="max-width:800px;">';
        foreach ($slides as $slide)
        {
            $data .= $this->img($slide['link'], 'slides', 'width:100%;');
//            $data .= '<img class="slides " src="'.$slide['link'].'" style="width:100%;">';
        }

        $data .= '<div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-topmiddle" style="width:100%">';
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

    public function img($link, $class, $style)
    {
        return '<img class="loading '.$class.'" src="'.$link.'" style="'.$style.'">';
    }
}
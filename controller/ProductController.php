<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 25-5-2017
 * Time: 11:04
 */

if(isset($_POST['action'])) {
    $obj = new ProductController();
    switch ($_POST['action']) {
        case 'add':
            $obj->addProducts();
            break;
        case 'remove':
//            $obj->Remove();
            break;
        default:
    }
}

class ProductController {

    function __construct() {
//        session_start();
    }

    public function Sql() {
        require_once('web.php');
        require_once('DbHandler.php');
        return new DbHandler(DB_HOST,DB_DATABASE,DB_USER,DB_PASS);
    }

    public function getProducts() {
        $item ='';
        foreach ($this->Sql()->Read('SELECT * FROM products') as $items) {
            $item .= '"'. $items['name'] .'",';
        }
        return $item;
    }

    public function addProducts() {
        $data = '';
        if(!empty($_POST['product'])) {
            $item = $this->Sql()->Read("SELECT * FROM products WHERE name ='" . $_POST['product'] . "'");
            if(isset($item[0]['name'])) {
                $data = 'Already exists';
            } else {
                $data =$this->Sql()->Create("INSERT INTO products(name) VALUE ('".$_POST['product']."');");
            }
        } else {
            $data = 'Fill in "Product"';
        }
        echo $data;
    }

    public function sendWhatsapp() {
        $data = '';
        if (isset($_SESSION["cart_item"])) {
            $data .= '<a href="https://api.whatsapp.com/send?phone=+31644559558&text=*order*%0A%0A';
            foreach ($_SESSION["cart_item"] as $item) {
                $data .= ucfirst($item['product']).'%20*'.$item['amount'].'x*%0A';
            }
            $data .= '" target="_blank"><img src="http://cdn.downdetector.com/static/uploads/c/300/e556a/whatsapp-messenger.png" alt="Whatsapp" height="50px"></a>';
        }
        return $data;
    }
}
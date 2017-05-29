<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 25-5-2017
 * Time: 12:00
 */

if(isset($_POST['action'])) {
    $obj = new ListController();
    switch ($_POST['action']) {
        case 'add':
            $obj->Add();
            break;
        case 'remove':
            $obj->Remove();
            break;
        default:
    }
}

class ListController {

    function __construct() {
        session_start();
    }

    public function Sql() {
        require_once('web.php');
        require_once('DbHandler.php');
        return new DbHandler(DB_HOST,DB_DATABASE,DB_USER,DB_PASS);
    }

    public function Add() {
        $data = '';
        if(!empty($_POST['product'])) {
            if (!empty($_POST["amount"])) {
                $article = $this->Sql()->Read("SELECT * FROM products WHERE name ='" . $_POST['product'] . "'");
                if(isset($article[0]['name'])) {
                    $itemArray = array($article[0]["name"] => array('id' => $article[0]["id"], 'product' => $article[0]["name"], 'amount' => $_POST["amount"]));

                    if (!empty($_SESSION["cart_item"])) {
                        if (in_array($article[0]["name"], $_SESSION["cart_item"])) {
                            foreach ($_SESSION["cart_item"] as $k => $v) {
                                if ($article[0]["name"] == $k)
                                    $_SESSION["cart_item"][$k]["amount"] = $_POST["amount"];
                            }
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
            }
        }
        if (isset($_SESSION["cart_item"])) {
            foreach ($_SESSION["cart_item"] as $item) {
                $data .= '<li><a href="chart?id='.$item['id'].'">'.ucfirst($item['product']).'</a></li>';
            }
        }
        echo $data;
    }

    public function Remove() {
        $name = $this->Sql()->Read("SELECT * FROM products WHERE id ='" . $_POST['id'] . "'");

        $data = '';
        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                if($name[0]['name'] == $k)
                    unset($_SESSION["cart_item"][$k]);
                if(empty($_SESSION["cart_item"]))
                    unset($_SESSION["cart_item"]);
            }
        }
        if(isset($_SESSION["cart_item"])) {
            foreach ($_SESSION["cart_item"] as $item) {
                $data .= '<a class="list-group-item" onclick="Remove('.$item['id'].')"><b>'.ucfirst($item['product']).'</b><span class="badge">'.$item['amount'].'</span></a>';
            }
            $data .= $this->sendWhatsapp();
        } else {
            $data = '<a class="list-group-item"><b>Is empty</b></a>';
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
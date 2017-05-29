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
        if(isset($_POST['id'])) {
            $article = $this->Sql()->Read("SELECT * FROM articles WHERE id =" . $_POST['id']);
            if(isset($article[0]['title'])) {
                $itemArray = array($article[0]["title"] => array('id' => $article[0]["id"], 'title' => $article[0]["title"], 'amount' => $_POST["amount"]));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($article[0]["title"], $_SESSION["cart_item"])) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($article[0]["title"] == $k)
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
        if (isset($_SESSION["cart_item"])) {
            foreach ($_SESSION["cart_item"] as $item) {
                $data .= '<li><a href="chart?id='.$item['id'].'">'.ucfirst($item['title']).'</a></li>';
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
                $data .= '<li><a href="chart?id='.$item['id'].'">'.ucfirst($item['title']).'</a></li>';
            }
        } else {
            $data = '<li><a>U heeft geen producten in uw winkelwagen.</a></li>';
        }
        echo $data;
    }
}
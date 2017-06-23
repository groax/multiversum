<?php

//if(isset($_POST['action'])) {
//    $obj = new CartController();
//    switch ($_POST['action']) {
//        case 'add':
//            $obj->Add();
//            break;
//        case 'remove':
//            $obj->Remove();
//            break;
//        default:
//    }
//}

class CartController extends Controller
{
    public $id;
    public $amount;

    function __construct()
    {
        $this->id = $_POST['id'];
        $this->amount = $_POST['amount'];
//        session_start();
    }

    public function Add()
    {

        $id = $this->id;
        $amount = $this->amount;

        $data = '';
        if(isset($id)) {
            $article = Controller::sql()->Read("SELECT * FROM articles WHERE id =" . $id[0]);
            if(isset($article[0]['title'])) {
                $itemArray = array($article[0]["title"] => array('id' => $article[0]["id"], 'title' => $article[0]["title"], 'amount' => $amount));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($article[0]["title"], $_SESSION["cart_item"])) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($article[0]["title"] == $k)
                                $_SESSION["cart_item"][$k]["amount"] = $amount;
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
                $data .= '<li><a href="'.WEB_DIR.'details/show/'.$item['id'].'">'.ucfirst($item['title']).'</a></li>';
            }
        }
        echo $data;
    }

    public function Remove($id)
    {
        $name = Controller::sql()->Read("SELECT * FROM products WHERE id ='" . $id . "'");

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
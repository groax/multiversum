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
        if(isset($_POST['amount'])) {
            $this->id = $_POST['id'];
            $this->amount = $_POST['amount'];
        } else {
            $this->id = $_POST['id'];
        }
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
                $itemArray = array($article[0]["title"] => array('id' => $article[0]["id"], 'title' => $article[0]["title"], 'amount' => $amount, 'image' => $article[0]['image']));

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
            foreach ($_SESSION["cart_item"] as $cart) {
                $data .= '<li  class="w3-padding-16">';
                $data .= '<span onclick="remove('.$cart['id'].')" class="w3-button w3-white w3-xlarge w3-right">×</span>';
                $data .= '<img src="'.$cart['image'].'" class="w3-left w3-circle w3-margin-right" style="width:50px;">';
                $data .= '<span class="w3-large"><a href="'.WEB_DIR.'details/show/'.$cart['id'].'">'.ucfirst($cart['title']).'</a></span><br>';
                $data .= '<span>Hoeveelheid: '.$cart['amount'].'</span>';
                $data .= '</li>';
                $data .= '<a href="'.WEB_DIR.'pay" class="w3-button w3-teal">Betalen</a>';
            }
        }
        echo $data;
    }

    public function Remove()
    {
        $id = $this->id;

        $name = Controller::sql()->Read("SELECT * FROM articles WHERE id ='" . $id . "'");

        $data = '';
        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                if($name[0]['title'] == $k)
                    unset($_SESSION["cart_item"][$k]);
                if(empty($_SESSION["cart_item"]))
                    unset($_SESSION["cart_item"]);
            }
        }
        if(isset($_SESSION["cart_item"])) {
            foreach ($_SESSION["cart_item"] as $cart) {
                $data .= '<li  class="w3-padding-16">';
                $data .= '<span onclick="remove('.$cart['id'].')" class="w3-button w3-white w3-xlarge w3-right">×</span>';
                $data .= '<img src="'.$cart['image'].'" class="w3-left w3-circle w3-margin-right" style="width:50px;">';
                $data .= '<span class="w3-large"><a href="'.WEB_DIR.'details/show/'.$cart['id'].'">'.ucfirst($cart['title']).'</a></span><br>';
                $data .= '<span>Hoeveelheid: '.$cart['amount'].'</span>';
                $data .= '</li>';
                $data .= '<a href="'.WEB_DIR.'pay" class="w3-button w3-teal">Betalen</a>';
            }
        } else {
            $data = '<p>U heeft geen producten in uw winkelwagen.</p>';
        }
        echo $data;
    }
}
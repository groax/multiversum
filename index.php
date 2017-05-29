<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 25-5-2017
 * Time: 00:51
 */

//function __autoload($className) {
//    $className = str_replace('..', '', $className);
//    require_once("controller/".$className.".php");
//}

session_start();

//unset($_SESSION["cart_item"]);

require_once('controller/Controller.php');
require_once('controller/DbHandler.php');
require_once('controller/PageController.php');
$page = new PageController();

foreach ($page->Sql()->Read("SELECT * FROM pages;") as $item) {
    $page->add($item['pagetag']);
}
//
//$page->add('/');
//$page->add('/home');
//$page->add('/order');
//$page->add('/add');

$page->route();
?>

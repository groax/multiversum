<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 25-5-2017
 * Time: 00:51
 */

session_start();

//unset($_SESSION["cart_item"]);

require_once('controller/Controller.php');
require_once('controller/Route.php');
require_once('model/DbHandler.php');
require_once('model/HtmlHandler.php');
require_once('model/validation.php');
require_once('vendor\mollie\mollie-api-php\src\Mollie\API\Autoloader.php');

require_once 'vendor/autoload.php';

$route = new Route();

?>

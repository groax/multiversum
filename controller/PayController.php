<?php

/**
 * Created by PhpStorm.
 * User: Rick Holtman
 * Date: 6/24/2017
 * Time: 4:20 PM
 */

class PayController extends  Controller
{

    private $mollie;

    function __construct()
    {
        $this->mollie = new Mollie_API_Client;
        $this->mollie->setApiKey("test_Jfgu3TAj2Cmgt3yEmSA2KPQcSeRjjN");
    }

    public function index()
    {
        $content = Controller::View('Pay/index');
        $title = 'home';
        $nav = Controller::Navbar();
        include(Controller::View('layout'));
    }

    public function create()
    {
        try {
            $mollie = $this->mollie;
            $payment = $mollie->payments->create(
                array(
                    "amount" => 10.00,
                    "description" => "Multiversum betalen",
                    "redirectUrl" => "http://localhost/multiversum/pay/show",
                    "webhookUrl" => "https://webshop.example.org/mollie-webhook/",
                )
            );
        }
        catch(Mollie_API_Exception $e)
        {
            $error = "API call failed: " . htmlspecialchars($e->getMessage());
            $error .= " on field " . htmlspecialchars($e->getField());
        }
    }
}
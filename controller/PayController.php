<?php

/**
 * Created by PhpStorm.
 * User: Rick Holtman
 * Date: 6/24/2017
 * Time: 4:20 PM
 */

class PayController extends Controller
{
    private $mollie;
    private $payment;
    public $validation;

    function __construct()
    {
        $this->mollie = new Mollie_API_Client;
        $this->mollie->setApiKey("test_Jfgu3TAj2Cmgt3yEmSA2KPQcSeRjjN");
        $this->validation = new validation();
    }

    public function check()
    {
        $error = '';
        $val = $this->validation;
        $val->isText($_POST['firstname'], 'Voornaam')->lenghtMax(10);
        $val->isText($_POST['lastname'], 'Achternaam')->lenghtMax(10);
        $val->isNumber($_POST['phone'], 'Telefoon')->lenghtMax(10);
        $val->email($_POST['email'], 'Email');
//        var_dump($val);

        foreach ($val->error as $item) {
            $error .= $item;
        }
        echo $error;
    }

    public function index()
    {
        $payment = '';
        $content = Controller::View('Pay/index');
        $title = 'Betalen';
        $nav = Controller::Navbar();
        $data = Controller::html()->title('Betalen', '12', 2, true, false);
        include(Controller::View('layout'));
    }

    public function create()
    {
        try {
            $mollie = $this->mollie;
            $this->payment = $mollie->payments->create(
                array(
                    "amount" => 10.00,
                    "description" => "Multiversum betalen",
                    "redirectUrl" => "http://localhost/multiversum/pay/show",
                )
            );
        }
        catch(Mollie_API_Exception $e)
        {
            $error = "API call failed: " . htmlspecialchars($e->getMessage());
            $error .= " on field " . htmlspecialchars($e->getField());
        }
        $order_id = $this->payment->id;
        $this->session($order_id, 'blub');
        header('location: ' . $this->payment->getPaymentUrl());
    }
    public function show()
    {
        $data = '';

        $content = Controller::View('Pay/show');
        $title = 'Betalen';
        $nav = Controller::Navbar();

        $payment = $this->mollie->payments->get($_SESSION['order_id']);

        if ($payment->isPaid()) {
            $data = "Payment received.";
        }

        include(Controller::View('layout'));
    }

    function session($order_id, $status)
    {
        $_SESSION['order_id'] = $order_id;
        $_SESSION['status'] = $status;
    }
}
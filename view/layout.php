<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 25-5-2017
 * Time: 02:22
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo ucfirst($title) ?> | <?php echo TITLE ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Add a gray background color and some padding to the footer */
        footer {
            background-color: #f2f2f2;
            padding: 25px;
        }

        hr {
            /*border-bottom: 1px solid black;*/
            /*margin-top: -13px;*/
        }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home"><img src="http://prephardwineasy.com/wp-content/uploads/2017/05/mvm_m-766x431.png" alt="Logo" height="30px"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <?php
                    foreach ($nav as $n) {
                        echo '<li><a href="'.$n['pagetag'].'">'.ucfirst($n['pagename']).'</a></li>';
                    }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-shopping-cart"></span>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                            if(!isset($_SESSION["cart_item"])) {
                                echo "<li><a>U heeft geen producten in uw winkelwagen.</a></li>";
                            }
                            if(isset($_SESSION["cart_item"])) {
                                foreach ($_SESSION["cart_item"] as $item) {
                                    echo '<li><a href="chart?id='.$item['id'].'">'.ucfirst($item['product']).'</a></li>';
                                }
                            }
                        ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <?php @include($content); ?>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>

<script type="text/javascript">
    var list = document.querySelector('.dropdown-menu');
    var PRODUCT = document.getElementById('product');
    var AMOUNT = document.getElementById('amount');

    function Add(ACTION) {
        $.ajax({
            type:"POST",
            url:"./controller/CartController.php",
            data:{
                "action":ACTION,
                "product":PRODUCT.value,
                "amount":AMOUNT.value
            }
        }).done(function(data){
            list.innerHTML = data;
            if(!data.error){
                list.innerHTML = data;
            } else {
                list.innerHTML = '<li><a><b>Error</b></a></li>';
            }

        });
    }
</script>

</body>
</html>


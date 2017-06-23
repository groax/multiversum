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
    <title><?php echo ucfirst($title) ?> | <?php echo ucfirst(TITLE) ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo WEB_DIR ?>css/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="w3-sidebar w3-bar-block w3-border-right" style="display:none; z-index: 9999;" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
        <a href="<?php echo WEB_DIR ?>home" class="w3-bar-item w3-button">Home</a>
        <?php
            foreach ($nav as $n) {
                echo '<a href="'. WEB_DIR .$n['pagetag'].'"class="w3-bar-item w3-button">'.ucfirst($n['pagename']).'</a>';
            }
        ?>
    </div>

    <!-- Page Content -->
    <div class="w3-teal w3-top" style="z-index: 1;">
        <button class="w3-button w3-teal w3-xlarge" onclick="w3_open()">☰</button>
        <div class="w3-container">
            <h1><?php echo ucfirst(TITLE) ?></h1>
        </div>

        <div class="w3-teal w3-display-topright" style="z-index: 1;">
            <button class="w3-button w3-teal w3-xlarge" onclick="document.getElementById('id01').style.display='block'"><span class="fa fa-shopping-cart"></span></button>
        </div>
    </div>

    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-animate-top w3-card-4">
            <header class="w3-container w3-teal">
        <span onclick="document.getElementById('id01').style.display='none'"
              class="w3-button w3-display-topright">&times;</span>
                <h2>Winkelwagen</h2>
            </header>
            <div class="w3-container">
                <lu class="w3-ul" id="cart">
                <?php
                if(isset($_SESSION["cart_item"])) {
                    foreach ($_SESSION["cart_item"] as $cart) {
                        echo '<li  class="w3-padding-16">';
                        echo '<span onclick="remove('.$cart['id'].')" class="w3-button w3-white w3-xlarge w3-right">×</span>';
                        echo '<img src="'.$cart['image'].'" class="w3-left w3-circle w3-margin-right" style="width:50px;">';
                        echo '<span class="w3-large"><a href="'.WEB_DIR.'details/show/'.$cart['id'].'">'.ucfirst($cart['title']).'</a></span><br>';
                        echo '<span>Hoeveelheid: '.$cart['amount'].'</span>';
                        echo '</li>';
                    }
                } else {
                    echo '<p>U heeft geen producten in uw winkelwagen.</p>';
                }
                ?>
                </ul>
            </div>
            <footer class="w3-container w3-teal">
                <p>
                </p>
            </footer>
        </div>
    </div>

    <br><br><br><br><br>

    <div class="container content">
        <div class="row">
            <?php if(isset($content)) include($content); ?>
        </div>
    </div>

    <footer class="w3-container w3-bottom w3-teal" style="z-index: 0;">
        <p class="w3-center">Copyright <?php echo date('Y') ?> &copy; <a href="groax.com" target="_blank">groax.com</a> - Alle rechten voorbehouden.</p>
    </footer>

</body>

<script type="text/javascript">
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }
    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }

    $('img').load(function(){
        $(this).css('background','none');
    });

    function myAccFunc() {
        var x = document.getElementById("demoAcc");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }

    // Click on the "Jeans" link on page load to open the accordion for demo purposes
    document.getElementById("myBtn").click();

    function remove(ID) {
        $.ajax({
            type:"POST",
            url:"http://localhost/multiversum/cart/remove/"+ID,
            data:{
                "id":ID
            }
        }).done(function(data){
            cart.innerHTML = data;
            if(!data.error){
                cart.innerHTML = data;
            } else {
                error.innerHTML = '<li><b>Error</b></li>';
            }
        });
    }

</script>
</html>


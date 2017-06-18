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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
</div>

<br><br><br><br><br>

<div class="container content">
    <div class="row">
        <?php if(isset($content)) include($content); ?>
    </div>
</div>

<footer class="w3-container w3-bottom w3-teal" style="z-index: 0;">
    <p>Footer Text</p>
</footer>
</div>
<script type="text/javascript">
    var list = document.querySelector('.dropdown-menu');

    function Add(ID) {
        $.ajax({
            type:"POST",
            url:"./controller/CartController.php",
            data:{
                "id":ID,
                "action":"add",
                "amount":1
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

</script>

</body>
</html>


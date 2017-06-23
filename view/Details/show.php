<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 29-5-2017
 * Time: 14:54
 */

?>

<style>
    .slides
    {   display:none;
        height: auto;
        min-height: 200px;
        max-height: 500px;
        /*max-width: 200px;*/
    }
    .w3-left, .w3-right, .w3-badge {cursor:pointer}
    .w3-badge {height:13px;width:13px;padding:0}
</style>

<?php
   if(isset($data)) echo $data;
?>

<div class="col-s-6">
    <div class="error"></div>
</div>

<br><br>
<script>

    var slideIndex = 1;
    showDivs(slideIndex);

    var timer;
    startTimer();

    function startTimer() {
        timer = setInterval(function(){ plusDivs(1) }, 5000);
    }

    function stopTimer() {
        clearInterval(timer);
        startTimer();
    }

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function currentDiv(n) {
        showDivs(slideIndex = n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("slides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-white", "");
        }
        x[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " w3-white";
    }

    var error = document.querySelector('.error');
    var amount = document.getElementById('amount');
    var cart =  document.getElementById('cart');

    function add(ID) {
        $.ajax({
            type:"POST",
            url:"http://localhost/multiversum/cart/add/"+ID,
            data:{
                "id":ID,
                "amount":amount.value
            }
        }).done(function(data){
            cart.innerHTML = data;
            if(!data.error){
                cart.innerHTML = data;
            } else {
                error.innerHTML = '<li><a><b>Error</b></a></li>';
            }
        });
    }
</script>
<!--<pre>-->
<?php
//    print_r($_SESSION["cart_item"]);
//?>

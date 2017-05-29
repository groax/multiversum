<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 25-5-2017
 * Time: 10:30
 */

require_once('./controller/ProductController.php');
$product = new ProductController();

?>

<script type="text/javascript">
    var list = document.querySelector('.list-group');
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
                list.innerHTML = '<a class="list-group-item"><b>Error</b></a>';
            }

        });
    }
</script>

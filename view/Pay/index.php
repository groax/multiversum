<?php

/**
 * Created by PhpStorm.
 * User: Rick Holtman
 * Date: 6/24/2017
 * Time: 4:17 PM
 */

?>

<br>

<div class="w3-card-4">
    <div class="w3-container w3-teal">
        <h2>Informatie</h2>
    </div>
    <br>
    <form>
        <div class="w3-row-padding">
            <div class="w3-col" style="width:33%">
                <label for="firstname">Voornaam</label>
                <input form-data="pay" class="w3-input" type="text" id="firstname">
            </div>

            <div class="w3-col" style="width:33%">
                <label for="infix">Tussenvoegsel</label>
                <input form-data="pay" class="w3-input" type="text" id="infix">
            </div>

            <div class="w3-col" style="width:34%">
                <label for="lastname">Achternaam</label>
                <input form-data="pay" class="w3-input" type="text" id="lastname">
            </div>

            <div class="w3-col" style="width:50%">
                <label for="zipcode">Postcode</label>
                <input form-data="pay" class="w3-input" type="text" id="zipcode">
            </div>

            <div class="w3-col" style="width:50%">
                <label for="houseNumber">Huisnummer</label>
                <input form-data="pay" class="w3-input" type="text" id="houseNumber">
            </div>

            <div class="w3-col" style="width:50%">
                <label for="phone">Telefoon</label>
                <input form-data="pay" class="w3-input" type="text" id="phone">
            </div>

            <div class="w3-col" style="width:50%">
                <label for="email">Email</label>
                <input form-data="pay" class="w3-input" type="text" id="email">
            </div>
        </div>
    </form>
    <br>

    <div class="w3-row-padding" id="error"></div>

    <a class="w3-button w3-teal" id="check" style="margin: 15px;" onclick="submitForm('pay');document.getElementById('check').style.display='none'"">Controlleer</a>
</div>
<br>

<script>

    var error =  document.getElementById('error');
    var data = document.getElementById('data');

    var firstname = document.getElementById('firstname');

    function submitForm(name) {
        const formData = document.querySelectorAll('[form-data="' + name + '"]');
        let data = '';
        for(var i = 0; i < formData.length; i++) {
            data += formData[i].id + '=' + formData[i].value + '&';
        }

        data = data.slice(0, -1);

        ajax_post('<?php echo WEB_DIR ?>pay/check', data, responseText => {
            error.innerHTML = responseText;
        });
    }

    function ajax_post(url, data, callback) {
        var ajax = new XMLHttpRequest();
        ajax.open("POST", url, true);

        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        ajax.onreadystatechange = function() {
            if(ajax.readyState == 4 && ajax.status == 200) {
                callback(ajax.responseText);
            }
        }
        ajax.send(data);
    }
</script>

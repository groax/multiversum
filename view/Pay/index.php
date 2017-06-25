<?php

/**
 * Created by PhpStorm.
 * User: Rick Holtman
 * Date: 6/24/2017
 * Time: 4:17 PM
 */

if(isset($data)) echo $data;

?>

<form>
    <div class="w3-row-padding">
        <div class="w3-col" style="width:40%">
            <label for="firstname">Voornaam</label>
            <input class="w3-input" type="text" id="firstname">
        </div>

        <div class="w3-col" style="width:20%">
            <label for="infix">Tussenvoegsel</label>
            <input class="w3-input" type="text" id="infix">
        </div>

        <div class="w3-col" style="width:40%">
            <label for="lastname">Achternaam</label>
            <input class="w3-input" type="text" id="lastname">
        </div>

        <div class="w3-col" style="width:100%">
            <h3>Adres</h3>
            <hr>
        </div>

        <div class="w3-col" style="width:20%">
            <label for="zipcode">Postcode</label>
            <input class="w3-input" type="text" id="zipcode">
        </div>

        <div class="w3-col" style="width:20%">
            <label for="houseNumber">Huisnummer</label>
            <input class="w3-input" type="text" id="houseNumber">
        </div>
    </div>
</form>

<br>

<a class="w3-button w3-teal" href="<?php WEB_DIR ?>pay/create">Betalen</a>

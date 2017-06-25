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

            <div class="w3-col" style="width:50%">
                <label for="zipcode">Postcode</label>
                <input class="w3-input" type="text" id="zipcode">
            </div>

            <div class="w3-col" style="width:50%">
                <label for="houseNumber">Huisnummer</label>
                <input class="w3-input" type="text" id="houseNumber">
            </div>

            <div class="w3-col" style="width:50%">
                <label for="phone">Telefoon</label>
                <input class="w3-input" type="tel" id="phone">
            </div>

            <div class="w3-col" style="width:50%">
                <label for="email">Email</label>
                <input class="w3-input" type="email" id="email">
            </div>
        </div>
    </form>
    <br>
    <a class="w3-button w3-teal" style="margin: 15px;" href="<?php WEB_DIR ?>pay/create">Volgende</a>
</div>

<br>

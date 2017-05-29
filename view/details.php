<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 29-5-2017
 * Time: 14:54
 */

require_once('controller/PageController.php');
$page = new PageController();

?>

<div class="col-sm-12">
    <?php
        print_r($page->getArticle($_GET['id']));
    ?>
</div>
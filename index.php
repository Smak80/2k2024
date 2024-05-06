<?php

require_once "common/page.php";
require_once "common/a_content.php";

class index extends common\a_content{

    function show_content()
    {
        ?>
        <div>
            ОСНОВНОЙ КОНТЕНТ СТРАНИЦЫ
        </div>
        <?php
    }
}

new \common\page(new index());
?>
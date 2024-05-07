<?php

namespace common;

require_once "a_content.php";
require_once "common/menu.php";

class page
{
    private $content;
    private menu $menu;
    function __construct(a_content $content){
        $this->menu = new menu();
        $this->content = $content;
        $this->prepare_page();
        $this->show_heading();
        $this->show_menu();
        $this->show_content();
        $this->show_footer();
    }

    private function prepare_page()
    {
        ?>
        <html>
        <head>
            <link rel="stylesheet" type="text/css" href="/css/main.css">
            <title>Заголовок страницы</title>
        </head>
        <body>
        <?php
    }

    private function show_heading()
    {
        ?>
        <div class="header">
            ЗАГОЛОВОК
        </div>
        <?php
    }

    private function show_menu()
    {
        ?>
        <div class="menu">
            <?php
                $this->menu->show_menu();
            ?>
        </div>
        <?php
    }

    private function show_content()
    {
        print "<div class='content'>";
        $this->content->show_content();
        print "</div>";
    }

    private function show_footer()
    {
        ?>
        <div class="footer">
            © Маклецов С. В., 2024
        </div>
        </body>
        </html>
        <?php
    }
}
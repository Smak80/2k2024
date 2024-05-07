<?php

namespace common;

require_once "db_helper.php";

class menu
{
    private db_helper $db;

    public function __construct()
    {
        $this->db = db_helper::getInstance();
    }
    public function show_menu(): void
    {
        $items = $this->get_all_items();
        foreach ($items as $item){
            print '<div class="menuitem">';
            if ($item['url'] === $this->get_current_page()){
                print $item['name'];
            }
            else {
                print "<a href='{$item['url']}'>{$item['name']}</a>";
            }
            print '</div>';
        }
    }

    private function get_all_items(): array{
        return $this->db->get_all_data(tables::MENU);
    }

    private function get_current_page(): string{
        return mb_substr(preg_split('/\?/', $_SERVER['REQUEST_URI'])[0], 1);
    }

}
<?php

namespace common;

use mysqli_sql_exception;

enum tables: string{
    case MENU = 'menu';
}
class db_helper
{
    private \mysqli $mysql;
    private static ?db_helper $db = null;
    private function __construct()
    {
        $this->mysql = new \mysqli("localhost", "root", "", "2k2024", 3306);
    }

    public static function getInstance(): db_helper{
        if (self::$db == null){
            self::$db = new db_helper();
        }
        return self::$db;
    }

    public function get_all_data(tables $table)
    {
        try {
            $this->mysql->begin_transaction(name: "menu");
            // Имя таблицы не поддерживается в качестве параметра запроса.
            // Поэтому при создании запросов строковое значение
            // было изменено на перечисление
            $stmt = $this->mysql->prepare("SELECT * FROM $table->value");
//            if (!$stmt->bind_param('s', $table))
//                throw new mysqli_sql_exception("Ошибка привязки параметра");
            if (!$stmt->execute())
                throw new mysqli_sql_exception("Ошибка выполнения запроса");
            if (!$res = $stmt->get_result())
                throw new mysqli_sql_exception("Ошибка получения результатов запроса");
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            $this->mysql->commit(name: "menu");
            return $arr;
        } catch (mysqli_sql_exception $e) {
            print($e->getMessage());
            $this->mysql->rollback(name: "menu");
            return array();
        }
    }
}
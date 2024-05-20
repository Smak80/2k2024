<?php

require_once "common/page.php";
require_once "common/a_content.php";
require_once "common/db_helper.php";

enum error_type: string{
    case INVALID_LOGIN = 'Некорректный логин';
    case INVALID_PASSWORD = 'Некорректный пароль';
    case EMPTY_FIELDS = 'Заполните поля';
    case UNMATCHED_PASSWORDS = 'Пароли не совпадают';
}

class reg extends common\a_content{

    private error_type $error_type;

    function __construct()
    {
        unset($this->error_type);
        if (
            !isset($_POST['login']) ||
            !isset($_POST['password']) ||
            !isset($_POST['password_check'])
        ) {
            return;
        }

        $login = trim(htmlspecialchars($_POST['login']));

        $password = $_POST['password'];
        $password_check = $_POST['password_check'];

        if(!preg_match("/^[a-z][a-z0-9_]{1,28}[a-z0-9]$/i",$login)) {
            $this->error_type = error_type::INVALID_LOGIN;
        }

        // TODO: Выполнить остальные проверки

        $h_password = password_hash($password, PASSWORD_DEFAULT);

        \common\db_helper::getInstance()->reg_user($login, $h_password);


    }

    function show_content(): void
    {
        if (isset($this->error_type)) {
            echo $this->error_type->value;
        }
        ?>
        <div class="form-wrapper">
            <span>Регистрация</span>
            <form method="post" action="reg.php">
                <div class="input-wrapper">
                    <label for="login">Логин</label>
                    <input name="login" type="text" />
                </div>
                <div class="input-wrapper">
                    <label for="password">Пароль</label>
                    <input name="password" type="password"/>
                </div>
                <div class="input-wrapper">
                    <label for="password_check">Повторите пароль</label>
                    <input name="password_check" type="password"/>
                </div>
                <button type="submit">Зарегистрироваться</button>
            </form>
        </div>
        <?php
    }
}

new \common\page(new auth());
?>
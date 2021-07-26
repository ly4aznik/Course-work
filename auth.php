<?php
//Запускаем сессию
session_start();

//Добавляем файл подключения к БД
require_once("dbconnect.php");

//Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
$_SESSION["error_messages"] = '';

//Объявляем ячейку для добавления успешных сообщений
$_SESSION["success_messages"] = '';


/*
Проверяем была ли отправлена форма, то есть была ли нажата кнопка Войти. Если да, то идём дальше, если нет, то выведем пользователю сообщение об ошибке, о том что он зашёл на эту страницу напрямую.
 */
if(isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])){

    $login=$_POST['login'];
    $pass=$_POST['password'];

    $result_query_select = $mysqli->query("SELECT * FROM `admin` WHERE login = '".$login."' AND password = '".$pass."'");

    if(!$result_query_select){
        // Сохраняем в сессию сообщение об ошибке.
        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на выборке пользователя из БД</p>";

        //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: form_auth.php");

        //Останавливаем скрипт
        exit();
    }else{

        //Проверяем, если в базе нет пользователя с такими данными, то выводим сообщение об ошибке
        if($result_query_select->num_rows == 1){

            // Если введенные данные совпадают с данными из базы, то сохраняем логин и пароль в массив сессий.
            $_SESSION['admin'] = true;


            //Возвращаем пользователя на главную страницу
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: index.php");

        }else{

            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Неправильный логин и/или пароль</p>";

            //Возвращаем пользователя на страницу авторизации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: form_auth.php");

            //Останавливаем скрипт
            exit();
        }
    }

}else{
    exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=ly4aznik.ru> главную страницу </a>.</p>");
}

?>



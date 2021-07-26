<?php
    // Указываем кодировку
    

    $server = "localhost"; // имя хоста
    $username = "root"; // Имя пользователя БД
    $password = "root"; // Пароль пользователя.
    $database = "autocarrier"; // Имя базы данных,

    // Подключение к базе данных через MySQLi
    $mysqli = new mysqli($server, $username, $password, $database);

    // Проверяем, успешность соединения.
    if ($mysqli->connect_errno) {
        die("<p><strong>Ошибка подключения к БД</strong></p><p><strong>Код ошибки: </strong> ". $mysqli->connect_errno ." </p><p><strong>Описание ошибки:</strong> ".$mysqli->connect_error."</p>");
    }

    // Устанавливаем кодировку подключения
    $mysqli->set_charset('utf8');

    //Для удобства, добавим здесь переменную, которая будет содержать адрес (URL) нашего сайта
    $address_site = "http://perevozkarnd.ru/";
?>
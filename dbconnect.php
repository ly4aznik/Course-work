<?php
    // ��������� ���������
    

    $server = "localhost"; // ��� �����
    $username = "root"; // ��� ������������ ��
    $password = "root"; // ������ ������������.
    $database = "autocarrier"; // ��� ���� ������,

    // ����������� � ���� ������ ����� MySQLi
    $mysqli = new mysqli($server, $username, $password, $database);

    // ���������, ���������� ����������.
    if ($mysqli->connect_errno) {
        die("<p><strong>������ ����������� � ��</strong></p><p><strong>��� ������: </strong> ". $mysqli->connect_errno ." </p><p><strong>�������� ������:</strong> ".$mysqli->connect_error."</p>");
    }

    // ������������� ��������� �����������
    $mysqli->set_charset('utf8');

    //��� ��������, ������� ����� ����������, ������� ����� ��������� ����� (URL) ������ �����
    $address_site = "http://perevozkarnd.ru/";
?>
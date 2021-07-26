<?
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>perevozkarnd</title>
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="style.css">
        
    </head>
    <body>
    <div class="body__background">
        <header>
            <nav>
                <a  href="index.php">Главная</a>
                <a  href="schedule.php">Расписание для сотрудников</a>
                <a  href="salary.php">Расчет зарплаты</a>
                <?
                    if(!$_SESSION['admin'])
                    {
                        ?>
                        <a class="nav__link" href="form_auth.php">Для администратора</a>
                        <?
                    }
                ?>
                <?
                    if($_SESSION['admin'])
                    {
                        ?>
                        <a class="nav__link" href="schedule_admin.php">Редактировать расписание</a>
                        <a class="nav__link" href="exit.php">Выход</a>
                        <?
                    }
                ?>
            </nav>
        </header>
       
            <div class="schedule">
                <h2>Расписание на сегодня</h2>
                
                
                <?php
                echo date('d-m-Y');




              require_once 'dbconnect.php'; // подключаем скрипт
              $link = mysqli_connect($server, $username, $password, $database)
                or die("Ошибка " . mysqli_error($link));

              $query ="SELECT `route`,`bus`, `drivers`.`surname`, `cashiers`.`Surname`
                    FROM `routelist`, `drivers`, `cashiers`
                    WHERE `cashiers`.`Id_cashier` = `cashier`
                    AND `drivers`.`id_staff` = `driver`
                    AND `date` = CURRENT_DATE
                    ORDER BY `routelist`.`date`  ASC";

             $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
             if($result)
             {
                $rows = mysqli_num_rows($result); // количество полученных строк

                echo "<table><tr><th>Маршрут</th><th>Бортовой номер<br> автобуса</th><th>Водитель</th><th>Кондуктор</th></tr>";
                for ($i = 0 ; $i < $rows ; ++$i)
                {
                    $row = mysqli_fetch_row($result);
                    echo "<tr>";
                    for ($j = 0 ; $j < 5 ; ++$j) echo "<td>$row[$j]</td>";
                    echo "</tr>";
                }
                echo "</table>";


                // очищаем результат
                mysqli_free_result($result);


                if($rows==0){
                    echo "Нет рейсов в расписании";
                }

             }



             mysqli_close($link);

                ?>

            </div>

    </div>
</body>
</html>



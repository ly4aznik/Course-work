<?
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>perevozkarnd</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="body__background">
        <header>
            <nav>
                <a href="index.php">Главная</a>
                <a href="schedule.php">Расписание для сотрудников</a>
                <a href="salary.php">Расчет зарплаты</a>
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
             <h2>Расписание на неделю</h2>
            <form action="" method="post">
                <?php


                $cdate = date("Y-m-d");
                $week =  date('W', strtotime($cdate));
                $year =  date('Y', strtotime($cdate));
                $firstdayofweek = date("Y-m-d", strtotime("{$year}-W{$week}+1"));
                $lastdayofweek = date("Y-m-d", strtotime("{$year}-W{$week}-7"));
                






             require_once 'dbconnect.php';
             $link = mysqli_connect($server, $username, $password, $database);
             $query = "SELECT * FROM `drivers`";
             $result_select = mysqli_query($link,$query);
             echo "<select name = 'driver'>";
             while($object = mysqli_fetch_object($result_select)){

                 echo "<option value = '$object->surname' > $object->surname </option>";


             }

             echo "</select>";

                ?>
                <input type="submit" name="choosed_driver" value="Выбрать" />
                </form>

       
           
             <?php

            if(isset($_POST['choosed_driver'])){

                $link = mysqli_connect($server, $username, $password, $database)
                or die("Ошибка " . mysqli_error($link));

                $query ="SELECT `date`,`route`,`bus`, `drivers`.`Surname`, `cashiers`.`Surname`
                    FROM `routelist`, `drivers`, `cashiers`
                    WHERE `cashiers`.`Id_cashier` = `cashier`
                    AND `drivers`.`id_staff` = `driver`
                    AND `drivers`.`surname`='".$_POST["driver"]."'
                    AND `date`>='".$firstdayofweek."'
                    AND `date` <='".$lastdayofweek."'
                    ORDER BY `routelist`.`date`  ASC";

                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк

                    if($rows>0){

                        echo "<table><tr><th>Дата</th><th>Маршрут</th><th>Бортовой номер<br> автобуса</th><th>Водитель</th><th>Кондуктор</th></tr>";
                        for ($i = 0 ; $i < $rows ; ++$i)
                        {
                            $row = mysqli_fetch_row($result);
                            echo "<tr>";
                            for ($j = 0 ; $j < 5 ; ++$j) echo "<td>$row[$j]</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                    else{

                        echo "Нет рейсов в расписании";
                        }


                    // очищаем результат
                    mysqli_free_result($result);

                }

                mysqli_close($link);



            }

             ?>
        </div>
    </div>
</body>
</html>

<?
    mysqli_close($connect);
?>

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
       
        <div class="autorization">
            <h2>Раcчет зарплаты</h2>
            <form action="" method="post">



                <table>

                    <tbody>
                        <tr>
                            <td class="td_salary"> Водитель: </td>
                            <td>
                                <?php

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

                                <br />

                            </td>
                        </tr>

                        <tr>
                            <td class="td_salary"> Дата начала периода: </td>
                            <td>
                                <input type="date" id="date" name="date_start" />
                                <br />

                            </td>
                        </tr>

                        <tr>
                            <td class="td_salary"> Дата окончания периода: </td>
                            <td>
                                <input type="date" name="date_finish" />
                                <br />

                            </td>
                        </tr>


                        <tr>
                            <td colspan="2">
                                <input type="submit" name="btn_submit_salary" value="Запросить" />
                            </td>
                        </tr>
                    </tbody>
                </table>




            </form>

            <?php

            if (($_POST['date_finish']=='')||($_POST['date_start']=='')){

                echo "Выберите водителя и период" ;
            }
           



             if(isset($_POST['btn_submit_salary'])&&($_POST['date_finish']!='')&&($_POST['date_start']!='')){



                $link = mysqli_connect($server, $username, $password, $database)
                or die("Ошибка " . mysqli_error($link));

                $query ="SELECT `date`,`route`,`bus`, `drivers`.`Surname`, `cashiers`.`Surname`
                    FROM `routelist`, `drivers`, `cashiers`
                    WHERE `cashiers`.`Id_cashier` = `cashier`
                    AND `drivers`.`id_staff` = `driver`
                    AND `drivers`.`surname`='".$_POST["driver"]."'
                    AND `date`>='".$_POST['date_start']."'
                    AND `date` <='".$_POST['date_finish']."'
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


                        echo "Выполненных рейсов: ".$rows."<br>";

                        echo "Ставка за один выполненный рейс: 1500<br>";
                        echo "Выплата за указанный период: ".$rows*1500;

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

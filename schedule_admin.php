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
        
        <div class="content">
            <h2>Расписание</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>
                        <pre> Дата   </pre>
                    </th>
                    <th>Маршрут</th>
                    <th>
                        Бортовой номер
                        <br /> автобуса
                    </th>
                    <th>Водитель</th>
                    <th>Кондуктор</th>
                </tr>
            </table>
            <div class="schedule_inside">

                <?php


                require_once 'dbconnect.php'; // подключаем скрипт
                $link = mysqli_connect($server, $username, $password, $database)
                  or die("Ошибка " . mysqli_error($link));

                $query ="SELECT `id_list`,`date`,`route`,`bus`, `drivers`.`surname`, `cashiers`.`Surname`
                        FROM `routelist`, `drivers`, `cashiers`
                        WHERE `cashiers`.`Id_cashier` = `cashier`
                        AND `drivers`.`id_staff` = `driver`

                        ORDER BY `routelist`.`date`  ASC";

                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк

                    echo "<table><tr><th><pre>   </pre></th><th><pre>       </pre></th><th><pre>       </pre></th><th><pre>              </pre></th><th><pre>     </pre></th></tr>";
                    for ($i = 0 ; $i < $rows ; ++$i)
                    {
                        $row = mysqli_fetch_row($result);
                        echo "<tr>";
                        for ($j = 0 ; $j < 7 ; ++$j) echo "<td>$row[$j]</td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                    // очищаем результат
                    mysqli_free_result($result);
                }

                mysqli_close($link);

                ?>

            </div>



        </div>

           
        <div class="sidebar">

            <h2>Редактировать расписание</h2>
            <div style="height: 280px">
                <h3 style=" text-align: center;">Добавление записи</h3>
                <form action="" method="post">
                    <table>

                        <tbody>

                            <tr>
                                <td class="td_salary"> Дата: </td>
                                <td>
                                    <input type="date" name="date" />
                                    <br />

                                </td>

                                <td>
                                    <?php
                                   echo $_POST['date'];

                                    ?>

                                </td>
                            </tr>



                            <tr>
                                <td> Номер маршрута: </td>
                                <td>
                                    <?php

                                require_once 'dbconnect.php';
                                $link = mysqli_connect($server, $username, $password, $database);
                                $query = "SELECT * FROM `routes`";
                                $result_select = mysqli_query($link,$query);
                                echo "<select name = 'route'>";
                                while($object = mysqli_fetch_object($result_select)){

                                    echo "<option value = '$object->id_route' > $object->id_route </option>";


                                }

                                echo "</select>";

                                    ?>

                                    <br />

                                </td>
                                <td>
                                    <?php
                                   echo $_POST['route'];

                                    ?>

                                </td>

                            </tr>

                            <tr>
                                <td>
                                    Бортовой номер
                                    <br />автобуса:
                                </td>
                                <td>
                                    <?php
                                   require_once 'dbconnect.php';
                                   $link = mysqli_connect($server, $username, $password, $database);
                                   $query = "SELECT * FROM `buses`";
                                   $result_select = mysqli_query($link,$query);
                                   echo "<select name = 'bus'>";
                                   while($object = mysqli_fetch_object($result_select)){

                                       echo "<option value = '$object->id_auto' > $object->id_auto </option>";


                                   }

                                   echo "</select>";


                                    ?>

                                </td>
                                <td>
                                    <?php
                                   echo $_POST['bus'];

                                    ?>

                                </td>


                            </tr>
                            <tr>
                                <td colspan="5">
                                    <input type="submit" name="submit_route" value="Выбрать персонал" />
                                </td>
                            </tr>


                        </tbody>
                    </table>

                </form>


                <?php
               if(isset($_POST['submit_route'])&&($_POST['date']!='')):?>

                <form action="" method="post">
                    <table>

                        <tbody>




                            <tr>
                                <td> Водитель: </td>
                                <td>
                                    <?php

                                require_once 'dbconnect.php';
                                $link = mysqli_connect($server, $username, $password, $database);
                                echo "<select name = 'driver'>";
                                for($i = 1 ; $i <= 3 ; ++$i){
                                    $query = "SELECT `drivers`.`surname`,`driver_".$i."`AS driver
                                            FROM `buses`, `drivers`
                                            WHERE `id_auto` = '".$_POST['bus']."'
                                            AND `drivers`.`id_staff` = `driver_".$i."`";

                                    $result_select = mysqli_query($link,$query);
                                    $object = mysqli_fetch_object($result_select);
                                    echo "<option value = '$object->driver' > $object->surname </option>";
                                }



                                echo "</select>";
                                    ?>




                                </td>
                                <td>
                                    <?php


                                    ?>
                                    <pre></pre>
                                </td>

                                <td> Кондуктор: </td>
                                <td>

                                    <?php
                   require_once 'dbconnect.php';
                   $link = mysqli_connect($server, $username, $password, $database);
                   $query = "SELECT * FROM `cashiers`";
                   $result_select = mysqli_query($link,$query);
                   echo "<select name = 'cashier'>";
                   while($object = mysqli_fetch_object($result_select)){

                       echo "<option value = '$object->Id_cashier' > $object->Surname </option>";


                   }

                   echo "</select>";





                                    ?>

                                    <br />
                                </td>



                            </tr>

                            <tr>
                                <td colspan="5">
                                    <input type="submit" name="add" value="Добавить запись" />
                                </td>
                            </tr>







                        </tbody>
                    </table>
                    <input type="hidden" name="date" value="<?= $_POST['date'] ?>" />
                    <input type="hidden" name="route" value="<?= $_POST['route'] ?>" />
                    <input type="hidden" name="bus" value="<?= $_POST['bus'] ?>" />

                </form>




                <?php else: ?>



                <?php endif; ?>




                <?php
               if(isset($_POST['add'])){

                   require_once 'dbconnect.php';
                   $link = mysqli_connect($server, $username, $password, $database);
                   $query = "INSERT INTO `routelist` (`id_list`, `route`, `date`, `bus`, `driver`, `cashier`) VALUES (NULL, '".$_POST['route']."', '".$_POST['date']."', '".$_POST['bus']."', '".$_POST['driver']."', '".$_POST['cashier']."')";
                   mysqli_query($link,$query);
                   echo "<h2>Запись добавлена</h2>";
                   echo '<button value="Refresh Page" onClick="window.location.href=window.location.href">Обновить расписание</button>';











               }


                ?>



            </div>

            <div style=" text-align: left">
                <h3 style="text-align: center;">Удаление записи</h3>
                <form action="" method="post">
                    <table>
                        <tbody>
                            <tr>
                                <th>
                                    Введите индекс записи

                                </th>
                                
                            </tr>
                            
                            
                            <tr>

                                <th>
                                    <input type="text" name="id_list"  />
                                    <input type="submit" name="delete" value="Удалить" />
                                </th>

                            </tr>

                        </tbody>

                    </table>


                </form>
                      
                
                <?php
               if(isset($_POST['delete'])){

                   require_once 'dbconnect.php';
                   $link = mysqli_connect($server, $username, $password, $database);
                   $query = "DELETE FROM `routelist` WHERE `routelist`.`id_list` = ".$_POST['id_list'];
                   mysqli_query($link,$query);
                  
                   echo "<h2>Запись Удалена</h2>";
                   echo '<button value="Refresh Page" onClick="window.location.href=window.location.href">Обновить расписание</button>';



               }


                ?>


            </div>
           
        </div>
        
    
     </div>
    
    
    
    </body>
</html>



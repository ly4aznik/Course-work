<?php
    session_start();
?>
<?php
	if($_SESSION['message'])
	{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>perevozka_rostov.ru</title>
    <link rel="stylesheet" href="style.css" />

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

                <a href="exit.php">Выход</a>
                <?
					}
                ?>
            </nav>
        </header>


        <?php
        //Проверяем, если пользователь не авторизован, то выводим форму авторизации,
        //иначе выводим сообщение о том, что он уже авторизован
        if(!isset($_SESSION["email"])){
        ?>


        <div class="autorization">
            <h2>Авторизация</h2>
            <form action="auth.php" method="post" name="form_auth">
                <table>

                    <tbody>
                        <tr>
                            <td > Логин: </td>
                            <td>
                                <input type="text" name="login" placeholder="admin" required="required" />
                                <br />
                                <span id="valid_email_message" class="mesage_error"></span>
                            </td>
                        </tr>

                        <tr>
                            <td > Пароль: </td>
                            <td>
                                <input type="password" name="password" placeholder="123" required="required" />
                                <br />
                                <span id="valid_password_message" class="mesage_error"></span>
                            </td>
                        </tr>


                        <tr>
                            <td colspan="2">
                                <input type="submit" name="btn_submit_auth" value="Войти" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

        <?php
    }else{
        ?>

        <div id="authorized">
            <h2>Вы уже авторизованы</h2>
        </div>

        <?php
    }
        ?>

    </div>
</body>
</html>
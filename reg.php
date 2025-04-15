<?php
require_once 'bd.php';

if (isset($_REQUEST['goreg'])) {
    
    // пароль
    if (!$_REQUEST['password']) {
        $error = 'Введите пароль';
    }
 
    // email
    if (!$_REQUEST['email']) {
        $error = 'Введите email';
    }
 
    // логин
    if (!$_REQUEST['login']) {
        $error = 'Введите login';
    }

    // if vse ok!
    if (!$error) {
        $login = $_REQUEST['login'];
        $email = $_REQUEST['email'];
        // пароль хеш
        $pass = password_hash($_REQUEST['pass'], PASSWORD_DEFAULT);
        // хешируем хеш, который состоит из логина и времени
        $hash = md5($login . time());
        
        // Переменная $headers нужна для Email заголовка
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "To: <$email>\r\n";
        $headers .= "From: <mail@example.com>\r\n";
        // Сообщение для Email
        $message = '
                <html>
                <head>
                <title>Подтвердите Email</title>
                </head>
                <body>
                <p>Что бы подтвердить Email, перейдите по <a href="http://example.com/confirmed.php?hash=' . $hash . '">ссылка</a></p>
                </body>
                </html>
                ';
        
        // Добавление пользователя в БД
        mysqli_query($db, "INSERT INTO `reg_users` (`login`, `email`, `password`, `hash`, `email_val`) VALUES ('" . $login . "','" . $email . "','" . $pass . "', '" . $hash . "', 1)");
        // проверяет отправилась ли почта
        if (mail($email, "Подтвердите Email на сайте", $message, $headers)) {
            // Если да, то выводит сообщение
            echo 'Подтвердите на почте';
        }
    } else {
        // Если ошибка есть, то выводить её 
        echo $error; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Notex</title>
    <script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
        <div id="header">
            <a href="index.php"><p class="title1">NoteX</p></a>
        </div>
        
        <div class="registr">
            <form action="reg.php" method="post">
            
            <p>Логин</p>
            <p><input name="login" placeholder="Введите логин" pattern="[a-zA-Z0-9]+"></p>
            <p>E-mail</p>
            <p><input name="email" type="email" placeholder="Введите e-mail"></p>
            <p>Пароль</p>
            <div class="password">
            <input type="password" id="password-input" placeholder="Введите пароль" name="password">
	        <p><label ><input id="chel_pas" type="checkbox" class="password-checkbox" name="goreg"><img id ="img_pass"src="img/eye.png" ></label></p>
            </div>
           
            <script>
             $('body').on('click', '.password-checkbox', function(){
                if ($(this).is(':checked')){
                    $('#password-input').attr('type', 'text');
                } else {
                    $('#password-input').attr('type', 'password');
                }
            }); 
            </script>
            <button type="submit" name="regi" value="register">Зарегестрироваться</button>
        </form>
        <?php 
            
        ?>
        </div>
</body>
</html>
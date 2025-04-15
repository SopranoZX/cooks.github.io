<?php
require_once 'bd.php';
session_start();

$_SESSION['zdorov'] = $_POST["login1"];
if ($_POST["go_login"])
	{
		$login = ($_POST["login1"]);
		$pass = ($_POST["password1"]);
        
		if ($login && $pass)
		{
				
            

			
			$result = mysqli_query($db,"SELECT * FROM `reg_users` WHERE `login`= '$login' AND `password`='$pass'");
            if (mysqli_num_rows($result) > 0)

            
        {
            $row = mysqli_fetch_array($result);

            echo '<div style="color:green;">Вы авторизованы!<br> 
            Можете перейти на <a href="main.php?varname=<?php echo $login ?>">главную</a> страницу.</div><hr>';
        }else
        {
            $errors[] = 'Вы неправильно ввели логин или пароль';
   
        }
    if ( ! empty($errors) )
    {
        //выводим ошибки авторизации
        echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
    }
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
        <form method="post" action="" name="signin-form">
            <div class="form-element">
            <label>Логин</label>
                <input type="text" name="login1" pattern="[a-zA-Z0-9]+" required />
            </div>
            <div class="form-element">
             <label>Пароль</label>
             <input type="password" name="password1" required />
             </div>
            <input type="submit" name="go_login" value="login"></input>
        </form>
        </div>
</body>
</html>
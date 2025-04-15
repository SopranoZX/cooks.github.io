<?php
require_once 'bd.php';
session_start();
$login_trans = $_SESSION['zdorov1'];

if ($_POST["submit_add"])
	{
		$error = array();
		
		if ($_POST["form_title"] == 0)
		{
			$error[] = "Укажите название!";
		}
        if (!$_POST["form_text"])
		{
			$error[] = "Напишите текст заметки!";
		}

        if ($_POST["chk_war"] == "red")
		{
			$chk_war = "1";
		}else{$chk_war = "0";}

        if ($_POST["chk_war"] == "green")
		{
			$chk_nowar = "1";
		}else{$chk_nowar = "0";}



        mysqli_query($db,"INSERT INTO notes(title,text1,warn_red,warn_green,login_check)
				VALUES(
				'".$_POST["form_title"]."',
				'".$_POST["form_text"]."',
				'".$chk_war."',
				'".$chk_nowar."',
                '".$login_trans."'
				)");
                $_SESSION['message'] = 
                "<p id='form-success'>Заметка успешно добавлена!</p>
                 <br /> <a id='back' href='main.php'>Назад</a>";
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
</head>
<body>
        <div id="header">
            <a href="main.php"><p class="title1">NoteX</p></a>
        </div>
        <div id="menu">
    
        <a href="main.php"><p>Все заметки</p></a>
        <p></p>
        <a href="index.php"><p>Выйти</p></a>
            <p></p>
            <a href="add.php"><p>Добавить заметку</p></a>
        </div>
       <div>
            
        <p class ="title_m">Добавьте вашу заметку:</p>
           
       </div>
        <div>

        <form method="post">
	    <ul class="registr">
	
	    <li>
	    <label>Название</label>
	    <input id="add_title" type="text" name="form_title" />
	    </li></br>
	
	    <li>
	    <label for="form_text">Текст заметки</label>
	    <textarea id="add_text" type="textarea" name="form_text" ></textarea>
	    </li>
        </br>
        <label class="">Важность</label>
		
		
	    <input type="radio" value="red" name="chk_war" id="chk_war" /><label for="chk_war">Срочно</label>
	    <input type="radio" value ="green"name="chk_war" id="chk_nowar" /><label for="chk_nowar">Не срочно</label>

        <p ><input type="submit" id="submit_form" name="submit_add" value="Добавить заметку!"/></p>
	
	    </ul>
	    </form>

        </div>
       <?php
            
       ?>
</body>
</html>
<?php
require_once 'bd.php';
session_start();
$login_trans = $_SESSION['zdorov'];


$_SESSION['zdorov1'] = $login_trans;
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
            <a href="index.php"><p class="title1">NoteX</p></a>
        </div>
        <div id="menu">
    
        <a href="main.php"><p>Все заметки</p></a>
        <p></p>
        <a href="index.php"><p>Выйти</p></a>
            <p></p>
            
            <a href="add.php?varname=<?php echo $login ?>"><p>Добавить заметку</p></a>
        </div>
       <div>
            
        <p class="registr">Ваши заметки:</p>
           
       </div>
    
       <?php
            $result = mysqli_query($db,"SELECT * FROM `notes` WHERE `login_check` = '$login_trans'");
            if (mysqli_num_rows($result) > 0)
            {
            
                $row = mysqli_fetch_array($result);
                do
                {
                    if ($row["warn_red"] == 1){
                        $text12 = "Важно";
                    }
                    if ($row["warn_green"] == 1){
                        $text12 = "Не срочно";
                    }
                                       
                echo'
                <li class = "notes"><a>
                
                <div class="left-side">
                <p class="title-prod">
                    <b>'.$row["title"].'</b></br>
                    <a class="status"> Статус: '.$text12.'</a>
                    <a href="delete.php?id='.$row["id_note"].'" class="delete" >Удалить запись</a>
                </p>
                <a class="mini-size">                                                                                                                                                 
                '.$row["text1"].'
                </a>
                </div>
               
                </a>
                
                
	
                </li>
                
                
                ';
                }
                
                while ($row = mysqli_fetch_array($result)) ;
            }
       ?>
</body>
</html>
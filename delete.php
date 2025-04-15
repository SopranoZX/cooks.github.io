<?php
require_once 'bd.php';
	
session_start();

$id = $_GET["id"];


	
	mysqli_query($db,"DELETE FROM notes WHERE id_note ='$id'");
	

	
	header("Location: main.php");
?>
<?php

// Connexion à la base de données
require_once('bdd.php');
//echo $_POST['title'];
session_start();

if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])  && isset($_POST['type'])){
	
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$type = $_POST['type'];
	
	$userid = $_SESSION['userid'];
	// echo "<script type='text/javascript'>alert('$userid');</script>";
	
	$sql = "INSERT INTO events(title, start, end, color, type, userid) values ('$title', '$start', '$end', '$color', '$type', '$userid')";
	
	
	
	//$req = $bdd->prepare($sql);
	//$req->execute();
	
	echo $sql;
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);
header("Refresh:0");

	
?>

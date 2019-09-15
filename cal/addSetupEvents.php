<?php

require_once('bdd.php');
session_start();

if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])  && isset($_POST['type'])){
	
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$type = $_POST['type'];

	if($type == 2)
	{
		$end = "";
	}
	$userid = $_SESSION['userid'];
	// echo "<script type='text/javascript'>alert('$userid');</script>";
    echo $userid;
    print_r($_POST['title']);
	// $sql = "INSERT INTO events(title, start, end, color, type, userid) values ('$title', '$start', '$end', '$color', '$type', '$userid')";
	
	// $query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Error in prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error in execute');
	}

}
// header('Location: '.$_SERVER['HTTP_REFERER']);
// header("Refresh:0");

	
?>

<?php
	session_start();
	$db = new PDO('mysql:host=localhost;dbname=logowanie','root','');
	 
	$query = $db->prepare("SELECT * FROM message");
	$query ->execute();
	 
	while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
	   $name = $fetch['name'];
	   $message = $fetch['message'];
	   $id = $fetch['id'];
	 
	   echo "<li id='$id' class='msg'><b>".ucwords($name).":</b> ".$message."</li>";
	}
 
?>
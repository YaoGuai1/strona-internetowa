<?php
	session_start();
	$db = new PDO('mysql:host=localhost;dbname=logowanie','root','');
   if(isset($_POST['text']) && isset($_POST['name'])) {
 
      $text = strip_tags(stripslashes($_POST['text']));
      $name = strip_tags(stripslashes($_POST['name']));
      if(!empty($text) && !empty($name)) {
         $insert = $db->prepare("INSERT INTO message VALUES('', '".$name."', '".$text."')");
         $insert->execute();
 
         echo "<li class='msg'><b>".ucwords($name).":</b> ".$text."</li>";
      }
   }
 
 ?>
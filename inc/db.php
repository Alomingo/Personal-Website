<?php     
try{
	$db=new PDO("mysql:host=localhost;dbname=bc;","root","root");
	$db->query("SET NAMES utf8");
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	}catch(PDOException $e){
		echo $e->getMessage().'<br/>';
	}

?>
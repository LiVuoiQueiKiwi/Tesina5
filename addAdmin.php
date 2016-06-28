<?php
	include("dbfunction.php");
	$DB=new Database();
	$DB->connDB("tesina5","root","");
	$DB->insertAdmin($_POST["id"]);
	$DB->conn=null;
	header("location: visualizzautenti.php");
?>

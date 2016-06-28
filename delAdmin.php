<?php
	include("dbfunction.php");
	$DB=new Database();
	$DB->connDB("tesina5","root","");
	$DB->deleteAdmin($_POST["id"]);
	$DB->conn=null;
	header("location: visualizzautenti.php");
?>

<?php
if (isset ($_POST["index"])){
$index=$_POST["index"];
//unset($_COOKIE['brano'.$index]);
setcookie ("brano".$index, "");
//$_COOKIE['brano'.$index]="";
//unset($_COOKIE['brano'.$index]);
header("Location:main.php");
}

/*time()-3600*/




?>
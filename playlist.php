<?php

 if (isset ($_POST["nomefile"])){
     $i=0;       
     while(true){
         if($_COOKIE["brano".$i]==null){
             setcookie("brano".$i,$_POST["nomefile"]);
             if ($_COOKIE["brano".$i]==null) //controllo dopo il setcookie
                 break;
        }
        else $i++;   
    }
}
header("Location:main.php");

?>

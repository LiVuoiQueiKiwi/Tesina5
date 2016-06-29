<?php
        if (isset($_GET['filename'])) {
            $file=$_GET['filename'];

$p = "mp3/"; // change the path to fit your websites document structure
$path = $p.$file;
 
if ($fd = fopen ($path, "r")) {
    $fsize = filesize($path);
    $path_info = pathinfo($path); //   restituisce un vettore associativo contenente informazioni riguardo path. 
                                //Nel vettore vegono riportati i seguenti elementi: dirname, basename e extension. 
                                //Infatti andremo a prendere 
                                //il basename che ci servirà per il download tramite gli Header
    header("Content-type: application/octet-stream");
    header("Content-Disposition: filename=\"".$path_info["basename"]."\"");   
    header("Content-length: $fsize");
    header("Cache-control: private"); 
    //Evitiamo che scarichi un file mp3 corrotto e quindi provoca una non lettura all' apertura
    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}
fclose ($fd);
exit;
        }

?>


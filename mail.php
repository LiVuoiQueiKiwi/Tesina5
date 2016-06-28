<?php 
if(isset($_POST['invia'])){
    $to = "magicphp@outlook.com"; // Indirizzo Destinatario
    $from = $_POST['email']; // Indirizzo Mittente
    $first_name = $_POST['nome'];
    $subject = $_POST['oggetto'];
    $message = $first_name." Ha scritto:" . "\n\n" . $_POST['messaggio'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    echo "Mail spedita " . $first_name . ", ti contatteremo a breve.";
   
    
    
    }
?>

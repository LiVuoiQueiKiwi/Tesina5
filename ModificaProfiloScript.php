<?php
	//includo il file php "database.php" per utilizzare la classe Database
	include ('dbfunction.php');
    session_start();
	//classe con le funzioni inerenti alla registrazione di un nuovo utente
	class Modifica {
		
		//variabili pubbliche per i dati di registrazione
		public $nome, $cognome, $email, $username, $password,$b;
		
		//funzione per salvare i dati scritti nella form della pagina nelle varibili pubbliche
		public function readForm ($b) {
			$nome = $_POST["nome"];
			$cognome = $_POST["cognome"];
			$email = $_POST["email"];
			$username = $_POST["username"];
			$password = $_POST["password"];
		    $password= sha1($password);
		
		//funzione per l'inserimento dei dati del nuovo utente nella tabella utenti
		      $insert = "
				UPDATE utenti
				SET nome='$nome',cognome='$cognome',email='$email',username='$username',password='$password'
				WHERE username = '".$_SESSION['username']."';
				";
			try{
                $b->conn->exec($insert);
                session_unset();
                session_destroy();
                session_start();
                $_SESSION['username']=$username;
                header("location:VisualizzaProfilo.php");
            }
			catch(PDOException $e){header("location:ModificaProfilo.php");}
		}
		
	}	
		//creo un oggetto Database e mi connetto al DB
        
		$B = new Database();
		$B->connDB("tesina5","root","");
		//creo un oggetto Registrati
		$M = new Modifica();
		//leggo i dati passati dalle form
		$M->readForm($B);
        $B->conn=null;
		
?>
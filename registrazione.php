<?php
	class Registrazione{
		public $pdo;
		
		public function connDB(){
			try{
				$this->pdo=new PDO("mysql:host=localhost;dbname=tesina5","root","");
			}
			catch(PDOException $ex){
				echo "Connessione fallita!";
				exit();
			}
		}
		
		public function registrazioneUtente(){ //registrazione di un nuovo utente
			
			$nome=$_POST["nome"];
			$cognome=$_POST["cognome"];
			$mail=$_POST["email"];
			$user=$_POST["username"];
			$password=$_POST["password"];
            if (!($nome=="" || $cognome=="" || $mail =="" || $user=="" || $password=="")){
                $password=sha1($password);
                $sql="	SELECT username, email
                        FROM utenti;";
                foreach($this->pdo->query($sql) as $row){
                    if($user==$row['username'] || $mail==$row['email'])  {
                        header("location: popupRL.html");	
                        exit(0);
                    }


                }
                
                $dml=" INSERT INTO utenti (nome,cognome,username,email,password) VALUES('$nome','$cognome','$user','$mail','$password')";
				$res=$this->pdo->exec($dml);		
				$_SESSION['username'] = $user;
				header("location: Main.php");
			}
            else header("location: popupRL.html");
        }
    }

	session_start();
	$R=new Registrazione();
	$R->connDB();
	$R->registrazioneUtente();
	$pdo=null;
?>
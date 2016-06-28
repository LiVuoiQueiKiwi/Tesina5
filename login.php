<?php
	class Login{
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
		
		public function controlloUtente(){//controllo dell'accesso dell'utente con credenziali
			
			$user=$_POST["Username"];
			$password=$_POST["Password"];
            $password=sha1($password);
            if (!($user=="" || $password=="")){
                $sql="	SELECT username, password
					    FROM utenti;";
                foreach($this->pdo->query($sql) as $row){
				    if($user==$row['username']){
					   if($password==$row['password']){
						//accesso corretto. vai alla pagina home
						$_SESSION['username'] = $user;
						header("location: main.php");
                        exit(0);
					   } else
                            //ritorna alla pagina login con messaggio "Password sbagliata!"
                            header("location: loginpage.php"); 
                    }
                    else header("location: loginpage.php"); //errore username
			     }
            }
            else header("location: popupRL.html");
			//ritorna alla pagina login con messaggio "Nome utente sbagliato o non registrato!"
			
		}
	}
	
	session_start();
	$L=new Login();
	$L->connDB();
	$L->controlloUtente();
	$pdo=null;
?>
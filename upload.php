<?php
    include ('dbfunction.php');
class Upload{
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
     public function inserimentoCanzone(){
			$titoloC=$_POST["titolo"];
			$durata=$_POST["durata"];

			if((!($titoloC=="")) && (!($durata==""))){      
             
                
               
               $sql="	SELECT titolo
					FROM musica;";
			foreach($this->pdo->query($sql) as $row){
                if ($row['titolo']==$titoloC){
                    header("location: popup.html");
                    exit(0);
                }
    
            }          
                               
                if(isset($_POST['btn-upload'])){ 
					$file = $_FILES['file']['name'];
					$file_loc = $_FILES['file']['tmp_name'];
					$file_size = $_FILES['file']['size'];
					$file_type = $_FILES['file']['type'];
                    if($file_type != "audio/mp3"){
                        header("location: errorU.html");
                        exit(0);
                    }
                    else{
                        $folder="mp3/";
                        $size=round(((int)$file_size / 1048576),2) ;  //dimensione in MB
                        move_uploaded_file($file_loc,$folder.$file);				
                        $_SESSION['file']=$file;

                        $dml=" INSERT INTO Musica (titolo,dimensione, durata,nfile) VALUES ('".$titoloC."', '".$size."', '".$durata."','".$file."');";
                        $res=$this->pdo->exec($dml);
                        header("location: main.php"); //viene richiamata la pagina canzoni.php con passaggio di titolo dell'album per rimanere nella stessa pagina
                    }
			
			
			
		
            }
        else header("location: popup.html");
}
}
}

	session_start();
	$C=new Upload();
	$C->connDB();
	$C->inserimentoCanzone();
	$pdo=null;

?>
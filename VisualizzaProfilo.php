<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery.js"></script>

<?php
require_once('dbfunction.php');
?>
</head>
<body>
    
<div class="title">    
<div class="imgutente">
<?php
    require_once('dbfunction.php');
            session_start();
            $A = new Database();
            $A->connDB("tesina5","root","");
            $user=$_SESSION['username'];
            $queryid="SELECT IDutente FROM utenti WHERE username='$user'";
            $ris=$A->conn->query($queryid);
        
            foreach($ris as $r){
                if($A->contrAdmin ($r['IDutente'])) echo "<img src='images/admin.png'></div>";//(admin) si chiude il div "imgutente"
                else echo "<img src='images/utente.jpg'></div>"; //(utente) si chiude il div "imgutente"
            }
    
    echo "<div class='dropdown'>"
            .$_SESSION['username']."
            <div class='dropdown-content'>
                <div class='dropdown-content'>
                    <a href='VisualizzaProfilo.php'>Visualizza Profilo</a>
                    <a href='ModificaProfilo.php'>Modifica Profilo</a>";
                    $queryid="SELECT IDutente FROM utenti WHERE username='$user'";
                        $ris=$A->conn->query($queryid);  
        
                        foreach($ris as $r){
                            if($A->contrAdmin ($r['IDutente'])) echo "<a href='visualizzautenti.php'><i>Visualizza Utenti</i></a>";   
                        }
                echo"<a href='logout.php'>Logout</a>
              </div>
            </div>
        </div>";
  
    ?>
    <p class="ptitle">Download Project</p>

</div>    
<div class="container">
   <ul class="tabs">
        <li><a href="Main.php">Torna alla HomePage</a></li>
    </ul>
    <div style="clear:both;"></div>
	
    <div class="contenitore_tabs" >
        <div>
         <table class="mtable" height="200px;" style="margin-top:3%">
             <tr>
                 <?php
                    require_once('dbfunction.php');
                 class Account {	                    
		              public function datiAccount($d,$u){
                         $dati = "
                            SELECT *
                            FROM utenti
                            WHERE username = '$u';
                            ";
                        return $d->conn->query($dati);
                    }
                }
                $D=new Database();
                $D->connDB("tesina5","root","");
                $A=new Account();
                $impo=$A->datiAccount($D,$_SESSION['username']);
                foreach ($impo as $i) {
                    echo "<td rowspan='5'>";
                    if($D->contrAdmin ($i['IDutente'])) echo "<img src='images/admin.png'></td></tr>";//(admin) si chiude il div "imgutente"
                    else echo "<img src='images/utente.jpg'></td></tr>"; //(utente) si chiude il div "imgutente"
                    echo"
                         <td><b>Nome:<b></td><td>".$i['nome']."</td><tr>
                         <td><b>Cognome:<b></td><td>".$i['cognome']."</td><tr>
                         <td><b>Username:<b></td><td>".$i['username']."</td><tr>
                         <td><b>Email:<b></td><td>".$i['email']."</td><tr>
                         ";
                }
                
                 ?>
             <td colspan="3" width="100%" height="80px"><center><a href="ModificaProfilo.php"><button>Modifica Profilo</button></a></center></td>
        
            
            
            
            
        </table>   
        
            
        

            
            
        
        
        </div>
    </div>
</div>    
    

    
    
    
    
</body>














</html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery.js"></script>

<?php
include('dbfunction.php');
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
            <form action="ModificaProfiloScript.php" method="POST">
            <table class="mtable" height="200px;" style="margin-top:3%">
                <tr>
                    <?php
                        //include ('dbfunction.php');
                        class Account {	
	                	public function datiAccount($d,$u){
                                	$dati = " SELECT * FROM utenti WHERE username = '$u'; ";
                                	return $d->conn->query($dati);
                        	}
                        }
                    
                        $D=new Database();
                        $D->connDB("tesina5","root","");
                        $A=new Account();


                        foreach ($A->datiAccount($D,$_SESSION['username']) as $i) {
                             echo "<td rowspan='5'>";
                                if($D->contrAdmin ($i['IDutente'])) echo "<img src='images/admin.png'></td></tr>";//(admin) si chiude il div "imgutente"
                                else echo "<img src='images/utente.jpg'></td></tr>"; //(utente) si chiude il div "imgutente"
                             echo "<td><b>Nome:<b></td><td><input type='text' name='nome' value='".$i['nome']."'></td><tr>
                             <td><b>Cognome:<b></td><td><input type='text' name='cognome' value='".$i['cognome']."'</td><tr>
                             <td><b>Username:<b></td><td><input type='text' name='username' value='".$i['username']."'</td><tr>
                             <td><b>Email:<b></td><td><input type='email' name='email' value='".$i['email']."'</td><tr>
                             <td><b>Password:<b></td><td><input type='password' name='password' value='".$i['password']."'</td><tr>
                             ";
                        }

                     ?>
                <td colspan="3" width="100%" height="80px"><input type="submit" value="Salva le modifiche" /></td>
        </table>   
        </form>
           
        </div>
    </div>

</div>    
    

    
    
    
    
</body>
</html>

<html>
<head><link rel='stylesheet' type='text/css' href='style.css'></head>
<body>

    <?php
                include('dbfunction.php');
                session_start();
                $user=$_SESSION['username'];
                $A = new Database();
                $A->connDB("tesina5","root","");
                $queryid="SELECT IDutente FROM utenti WHERE username='$user'";
                $ris=$A->conn->query($queryid);  
                foreach($ris as $r){
                    if(!$A->contrAdmin ($r['IDutente'])) header('Location: error.html');   
                }
                
                echo "<div class='title'> <div class='imgutente'>";
                $queryid="SELECT IDutente FROM utenti WHERE username='$user'";
                $ris=$A->conn->query($queryid);  
                foreach($ris as $r){
                    if($A->contrAdmin ($r['IDutente'])) echo "<img src='images/admin.png'></div>";//(admin) si chiude il div "imgutente"
                    else echo "<img src='images/utente.jpg'></div>"; //(utente) si chiude il div "imgutente"
                }
                echo"
                <div class='dropdown'>".$_SESSION['username']."
                    <div class='dropdown-content'>
                        <div class='dropdown-content'>
                            <a href='VisualizzaProfilo.php'>Visualizza Profilo</a>
                            <a href='ModificaProfilo.php'>Modifica Profilo</a>";
                                require_once('dbfunction.php');
                                $user=$_SESSION['username'];
                                $A = new Database();
                                $A->connDB("tesina5","root","");
                                $queryid="SELECT IDutente FROM utenti WHERE username='$user'";
                                $ris=$A->conn->query($queryid);  
                                foreach($ris as $r){
                                    if($A->contrAdmin ($r['IDutente'])) echo "<a href='visualizzautenti.php'><i>Visualizza Utenti</i></a>";   
                                }   
                            echo "
                            <a href='logout.php'>Logout</a>
                        </div>
                    </div>
                </div>
                <p class='ptitle'>Download Project</p>
                </div>
                <div class='container'>
                    <ul class='tabs'>
                    <li><a href='Main.php'>Torna alla HomePage</a></li>
                    </ul>
                    <div style='clear:both;'></div>	
                    <div class='contenitore_tabs'>
                    <br><table class='mtable'><tr><th colspan='6'>Utenti Registrati</th></tr>";
            
                    $DB=new Database();
                    $DB->connDB("tesina5","root","");
                    $dati=$DB->datiUtenti();
                    foreach ($dati as $d) {
                        echo "<tr>
                            <td>".$d['username']."</td>";
                            if($DB->contrAdmin ($d['IDutente']) || $d['username']==$_SESSION['username'] )echo "<td></td>";
                            else echo "<td class='download'>
                                <form method='POST' action='addAdmin.php'>
                                    <input type='text' name='id' value='".$d['IDutente']."' style='visibility:hidden;width:0.1px;'>
                                    <input type='submit' value='Aggiungi Admin'>
                                </form>
                            </td>";
                            if(!$DB->contrAdmin ($d['IDutente']) || $d['username']==$_SESSION['username'] )echo "<td></td>";
                            else echo "<td class='download'>
                                <form method='POST' action='delAdmin.php'>
                                    <input type='text' name='id' value='".$d['IDutente']."' style='visibility:hidden;width:0.1px;'>
                                    <input type='submit' value='Cancella Admin'>
                                </form>
                            </td>";
                            echo "</tr>";
                    }
                    echo "</table></div></div></div>";         


    ?>
    
</body>
</html>



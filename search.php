<?php
include ('dbfunction.php');
    class search{
        
        public function LeggiForm($s){
            if(isset($_POST['brano'])){
                 $nome=$_POST['brano'];
                 $search="  SELECT *
                            FROM Musica
                            WHERE titolo LIKE '%$nome%' or nfile LIKE '%$nome%'";
                return $s->conn->query($search);
            
            }
        
        }
        
        
        
        
    }
        session_start();
        echo "<html><head><link rel='stylesheet' type='text/css' href='css/style.css'></head>";
        $S = new Database();
		$S->connDB("tesina5","root","");
		$SR = new search();
        echo "  <body>    
                    <div class='title'> <div class='imgutente'>";
                        $user=$_SESSION['username'];
                        $queryid="SELECT IDutente FROM utenti WHERE username='$user'";
                        $ris=$S->conn->query($queryid);  
                        foreach($ris as $r){
                            if($S->contrAdmin ($r['IDutente'])) echo "<img src='images/admin.png'></div>";//(admin) si chiude il div "imgutente"
                            else echo "<img src='images/utente.jpg'></div>"; //(utente) si chiude il div "imgutente"
                        }
                echo "
                        <div class='dropdown'>".$_SESSION['username']."
                            <div class='dropdown-content'>
                                <div class='dropdown-content'>
                                <a href='VisualizzaProfilo.php'>Visualizza Profilo</a>
                                <a href='ModificaProfilo.php'>Modifica Profilo</a>";
                                $queryid="SELECT IDutente FROM utenti WHERE username='$user'";
                                $ris=$S->conn->query($queryid);  
                                    foreach($ris as $r){
                                        if($S->contrAdmin ($r['IDutente'])) echo "<a href='visualizzautenti.php'><i>Visualizza Utenti</i></a>";   
                                    }
                                echo "<a href='logout.php'>Logout</a>
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
                        <div>
                        <form class='searchbar' action='search.php'  method='POST'>
                            <input type='text' name='brano' placeholder='Inserisci Nome brano...'><input class='searchbutton' type='submit' value='&nbsp;'>
                        </form><br>
                        <table class='mtable'>
                        <tr><th colspan='6'>Brani</th></tr>";
            
                    foreach( $SR->LeggiForm($S) as $ris){
                        echo "<tr>
                                <td>".$ris['nfile']."</td>
                                <td class='download'>
                                    <form method='GET' action='forcedownload.php'>
                                        <input type='text' name='filename' value='".$ris['nfile']."' style='visibility:hidden;width:0.1px;'>
                                        <input class='button' type='submit' value='Download' >
                                    </form>
                                </td>
                                <td class='download'>
                                    <form action='playlist.php' method='post'>
                               <input type='text' name='nomefile' value='".$ris['nfile']."' style='visibility:hidden;width:0.1px;'>
                                <input class='button'type='submit'  value='Aggiungi a Playlist'>
                                    </form>
                                </td>
                                </tr>";
                    }

                    echo "</table></div></div></div>";
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<script type="text/javascript" src="js/jquery.js"></script>

    
    
<!--SCRIPT DIV A COMPARSA-->
<script type="text/javascript">
$(document).ready(function() {
	
	$("#container").hide();
	$('#intro a').click(function(){
		$('body').animate({ backgroundColor: "#F9F9F9" }, 1000);
			

		$("#intro").fadeOut(function() {
      		$("#container").fadeIn();
			$('#intro').remove();
    	});
	});
	setInterval(function() {
          $('#intro a').click();
    }, 1800);
	
	
	//Quando la pagina viene caricata
	$(".blocco-tab").hide(); //nascondi tutti i contenuti delle tabs
	$("ul.tabs li:first").addClass("active").show(); //Attiva la prima tab
	$(".blocco-tab:first").show(); //Mostra il contenuto della prima tab

	//Al click sulla linguetta della tab
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Rimuovi ogni classe "active"
		$(this).addClass("active"); //E aggiungila solo a quella su cui ho cliccato
		$(".blocco-tab").hide(); //Nascondi tutti i contenuti delle tab

		var activeTab = $(this).find("a").attr("href"); //Trova l'href per identificare in modo univoco la tab ed il contenuto
		$(activeTab).fadeIn(); //Mostrami quest'ultimo con effetto di fadeIn
		return false;
		});

});
 
</script>
    
    
    

    
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
    
            echo "<div class='dropdown'>".$_SESSION['username']."
                    <div class='dropdown-content'>
                        <a href='VisualizzaProfilo.php'>Visualizza Profilo</a>
                        <a href='ModificaProfilo.php'>Modifica Profilo</a>";
                        $queryid="SELECT IDutente FROM utenti WHERE username='$user'";
                        $ris=$A->conn->query($queryid);  
        
                        foreach($ris as $r){
                            if($A->contrAdmin ($r['IDutente'])) echo "<a href='visualizzautenti.php'><i>Visualizza Utenti</i></a>";   
                        }
                        echo "<a href='logout.php'>Logout</a>
                    </div>
                </div>";
  
        ?>
        
<p class="ptitle">Download Project</p>
</div>    
    
<div class="container">
   <ul class="tabs">
        <li><a href="#tab1">Download DB</a></li>
        <li><a href="#tab2">La tua Musica</a></li>
        <li><a href="#tab3">Supporto</a></li>
       
        <?php
       
            require_once('dbfunction.php');
            $user=$_SESSION['username'];
            $A = new Database();
            $A->connDB("tesina5","root","");
            $queryid="SELECT IDutente FROM utenti WHERE username='$user'";
            $ris=$A->conn->query($queryid);  
       
            foreach($ris as $r){
                if($A->contrAdmin ($r['IDutente'])) echo "<li><a href='#tab4'>Upload</a></li>"; 
            }
       ?>   
       
    </ul>
    <div style="clear:both;"></div>
	
    <div class="contenitore_tabs" >
        
        <!--LABEL 1 //MUSICADB -->
        <div id="tab1" class="blocco-tab">
            <img src="images/img1.jpg" width="180" height="300" alt="tazza chiocciola" />
            
            <form class="searchbar" action="search.php"  method="POST">
                <input type="text" name="brano" placeholder="Inserisci Nome brano...">
                <input class="searchbutton" type="submit" value="&nbsp;">
            </form>
            <a href="Main.php"><button style="margin-left:100px;">Aggiorna Tabella</button></a><br><br>
            <div style="float:left; margin-left:-13%;overflow-y:scroll;height:300px;" id="sbar">
                
        <?php
            $lista = dir("mp3"); //stampo tutti i file dentro la cartella programmi
            echo "<table class='mtable'><tr><th colspan='6'>Brani</th></tr>";     
                                
               while ($f = $lista->read()){// Lista di tutti i file:             
                  if ($f!='.' && $f!='..')  
                      echo "<tr>
                            <td>$f</td>
                            <td class='download'>
                                <form method='GET' action='forcedownload.php'>
                                    <input type='text' name='filename' value='$f' style='visibility:hidden;width:0.1px;'>
                                    <input class='button' type='submit' value='Download ↓' >
                                </form>
                            </td>
                            <td class='download'>
                                <form action='playlist.php' method='post'>
                            <input type='text' name='nomefile' value='$f' style='visibility:hidden;width:0.1px;'>
                            <input  class='button' type='submit'  value='Aggiungi a Playlist ♫'>
                                </form>
                            </td>
                            </tr>";               
            }
            echo "</table>";
            $lista->close();
            echo "";
                
                
            
            ?>
            </div>       
        </div>
        
        <!--LABEL 2 //PLAYLIST -->
        <div id="tab2" class="blocco-tab">
            <img src="images/img2.jpg" width="180" height="300" alt="www" />
            <?php
                //GESTIONE DEI COOKIES
                echo "<table class='mtable'><tr><th colspan='6'>".$_SESSION['username']." Playlist</th></tr>";
                $i=0;
                while(true){
                    error_reporting(0);
                    if($_COOKIE['brano'.$i]==null) break;
                    else {
                         echo "<tr>
                                <td>".$_COOKIE['brano'.$i]."</td>
                                <td class='download'><audio controls><source src='mp3/".$_COOKIE['brano'.$i]."'></audio></td>
                               </tr>";
                        $i++;
                    }

                }
                echo "</table>";

            
            ?>
        
        </div>
        
        <!--LABEL 3 //SUPPORTO -->
        <div id="tab3" class="blocco-tab">
            <iframe class="maps" src="maps.html"></iframe>
            <form action="mail.php" method="post">
                <table class="mail" id="content">
                    <tr>
                        <td colspan="2">
                            <div class="heading">
                                <h3>Contact Us</h3>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nome:</label></td>
                        <td><input type="text" name="nome" placeholder="Nome" /></td>
                    </tr>
                    <tr>
                        <td><label>Email:</label></td>
                        <td><input type="text" name="email" placeholder="email@esempio.com" /></td>
                    <tr>
                        <td><label>Oggetto:</label></td>
                        <td><input type="text" name="oggetto" placeholder="Oggetto" /></td>
                    </tr>
                    <tr>
                        <td><label>Messaggio:</label></td>
                        <td><textarea name="messaggio" ></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button submit="invia" class="button"><span>invia</span></button></td>
                    </tr>
                </table>
            </form>        
        </div>
        
        <!--LABEL 4 //UPLOAD -->
        <div id="tab4" class="blocco-tab">
            <fieldset>
                <H3 align="center">Carica la tua Canzone nel nostro DB</H3>
                <FORM class="contupload" ACTION="upload.php" ENCTYPE='multipart/form-data' METHOD='post'>
                    Titolo:<input class="upload" type="text" name="titolo"><br>
                    Durata:<input class="upload" type="text" name="durata"><br> 
                    <input class="upload" type="file" name="file">
                    <input style="margin-top:15px" class="button" value="Inserisci canzone ♪" type="submit" name="btn-upload">
                </FORM>
            </fieldset>
        </div>
        
        
    </div>

</div>    
    
</body>
</html>

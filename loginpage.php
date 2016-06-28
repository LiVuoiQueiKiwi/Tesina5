<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>  
    <link rel="stylesheet" href="css/styleL.css">

    
    
    
  </head>

  <body>
    
      
    <div class="form">
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Registrati</a></li>
        <li class="tab"><a href="#login">Login</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Registrati!</h1>
          <form action="registrazione.php" method="POST">
              
            <div class="top-row">
                <div class="field-wrap">
                    <label>Nome</label><input type="text" name="nome">
                </div>
        
                <div class="field-wrap">
                    <label>Cognome</label><input type="text" name="cognome">
                </div>
            </div>
        
            <div class="field-wrap">
                <label>Username</label><input type="text" name="username">
            </div>
          
            <div class="field-wrap">
                <label>Email</label><input type="email" name="email">
            </div>
          
            <div class="field-wrap">
                <label>Password</label><input type="password" name=password>
            </div>
          
            <button type="submit" class="button button-block"/>Registrati
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Benvenuto!</h1>
          <form action="login.php" method="POST">
          
            <div class="field-wrap">
                <label>Username</label><input type="text" name="Username">
            </div>
          
            <div class="field-wrap">
                <label>Password</label><input type="Password" name="Password">
            </div>
          
            <input type="submit" class="button button-block" value="Login"/>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div>  
      
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>    

    
    
    
  </body>
</html>

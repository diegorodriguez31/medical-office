<html>
    <head>
       <meta charset="utf-8">
       <link rel = "stylesheet" href="BootStrap/css/notreStyle.css">
       <link rel="icon" href="Images/logo.ico" />
       <title>Page de connexion : Médic</title>
    </head>
    <body>         
            <form action="verification.php" method="POST" >
              <img src = "Images/LogoFinal.png">
                <input type="text" placeholder="Nom d'utilisateur" onfocus="this.placeholder = ''"
name="username" onblur="this.placeholder = 'Nom d\'utilisateur'" required><br>

                <input type="password" placeholder="Mot de passe" onfocus="this.placeholder=''" name="password" onblur="this.placeholder='Mot de passe'" required><br>

                <input type="submit" value = CONNEXION>

                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            </form>
    </body>
    <?php include('footer.php'); ?>
</html>


<style>

html, body {
  background-image: url('Images/Img_Connexion.jpg');
}

img{
  width: 250px;
  height: 200px;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

input{
    text-align:center;
}


body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f6;
}

form{
  width: 100%;
  max-width: 330px;
  padding: 20px;
  margin: auto;
  margin-top:0;
  background-color: rgba(250,250,230,0.5);
  border-radius: 10px;
  margin-top: 50px;
}

input {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
  border:none;
  background-color: rgba(250,250,230);
}

input[type="password"] {
  margin-bottom: 50px;
  margin-top: 15px;
   width: 100%;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  border-color: FD6B2B;
  border-width: 2px;
}

</style>
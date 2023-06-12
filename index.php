<?php include 'verifConnecte.php'; 
	if(isset($_GET['deconnexion'])){ 
       	if($_GET['deconnexion']==true){  
            session_unset();
			header("location:connexion.php");
   		}
	}
?>
<html>
<!DOCTYPE html>
<title>Médic</title>
<head>
	<?php include('header.php');?>
</head>
<link rel="stylesheet" href="BootStrap/css/notreStyle.css">
</html>

<style>
body{
   background-image: url('Images/BackAll3.jpg');
   background-size:cover;
}

</style>

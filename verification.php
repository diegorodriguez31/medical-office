<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    // connexion à la base de données
    include 'identifiantBDD.php';
    include 'connexionBDD.php';
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = htmlspecialchars($_POST['username']); 
    $password = htmlspecialchars($_POST['password']);
    
    if($username !== "" && $password !== "")
    {
        $requete = $linkpdo->prepare('SELECT count(*) FROM utilisateur where util = :util and pass = :pass ');
        $requete->execute(array('util'=>$username,
                                'pass'=>$password));
        $res = $requete->fetch()['count(*)'];
        if($res!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['username'] = $username;
           header('Location: index.php');
        }
        else
        {
           header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: connexion.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: connexion.php');
} // fermer la connexion
?>
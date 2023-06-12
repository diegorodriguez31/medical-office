<?php

	include 'identifiantBDD.php';
	include 'verifConnecte.php';
	if(isset($_POST['id'],$_POST['civilite'],$_POST['nom'],$_POST['prenom'])){
		try{
			$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
		}
		catch(Exception $e){
			die('Erreur : '.$e->getMessage());
		}

		$req = $linkpdo->prepare('UPDATE Medecin SET Civilite = :civ ,Nom = :nom ,Prenom = :prenom WHERE IdMedecin = '.$_POST['id']);

		$req->execute(array(
						'civ' => $_POST['civilite'],
						'nom' => $_POST['nom'], 
						'prenom' => $_POST['prenom']));
	}

	header('location:rechercheMedecin.php');

?>
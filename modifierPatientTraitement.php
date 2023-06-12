<?php

	include 'identifiantBDD.php';
	include 'verifConnecte.php';
	if(isset($_POST['id'],$_POST['civilite'],$_POST['nom'],$_POST['prenom'],$_POST['adresse'],$_POST['cp'],$_POST['ville'],$_POST['daten'],$_POST['lieun'],$_POST['numss'])){
		include 'connexionBDD.php';

		$req = $linkpdo->prepare('UPDATE Patient SET Civilite = :civ ,Nom = :nom ,Prenom = :prenom ,Adresse = :adresse,CodePostal = :cp,Ville= :ville,DateNaissance = :daten,LieuNaissance = :lieun,NumeroSecuriteSociale = :numss, IdMedecin = :idmed WHERE IdPatient = '.$_POST['id']);

		$req->execute(array(
						'civ' => $_POST['civilite'],
						'nom' => $_POST['nom'], 
						'prenom' => $_POST['prenom'], 
						'adresse' => $_POST['adresse'], 
						'cp'=> $_POST['cp'], 
						'ville'=>$_POST['ville'], 
						'daten'=>$_POST['daten'],
						'lieun'=>$_POST['lieun'],
						'numss'=>$_POST['numss'],
						'idmed'=>$_POST['idmed']));
	}

	header('location:recherchePatient.php');

?>
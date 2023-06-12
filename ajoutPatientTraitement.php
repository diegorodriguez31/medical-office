<?php
	include 'identifiantBDD.php';
	include 'connexionBDD.php';
	include 'verifConnecte.php';

	if(isset($_POST['civilite'],$_POST['nom'],$_POST['prenom'],$_POST['adresse'],$_POST['cp'],$_POST['ville'],$_POST['daten'],$_POST['lieun'],$_POST['numss'],$_POST['idmed'])){

		if(!empty($_POST['civilite']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['daten']) AND !empty($_POST['lieun']) AND !empty($_POST['numss'])){

			$requeteVerif = $linkpdo->prepare('SELECT * FROM Patient WHERE NumeroSecuriteSociale = :lenum');
			$requeteVerif -> execute(array('lenum' => $_POST['numss']));
			if($requeteVerif->fetchColumn() > 0){
				echo "Ce patient existe déjà :(";
			}else{
				$req = $linkpdo->prepare('INSERT INTO Patient (Civilite,Nom,Prenom,Adresse,CodePostal,Ville,DateNaissance,LieuNaissance,NumeroSecuriteSociale,IdMedecin) VALUES (:civ,:nom,:prenom,:adresse,:codepostal,:ville,:daten,:lieun,:numss,:idmed)');
				
				$req->execute(array(
					'civ' => $_POST['civilite'],
					'nom' => $_POST['nom'], 
					'prenom' => $_POST['prenom'], 
					'adresse' => $_POST['adresse'], 
					'codepostal'=> $_POST['cp'], 
					'ville'=>$_POST['ville'], 
					'daten'=>$_POST['daten'],
					'lieun'=>$_POST['lieun'],
					'numss'=>$_POST['numss'],
					'idmed'=>$_POST['idmed']));
			
				header('location: recherchePatient.php');
			}

			
		}else {
			echo "Aucun patient ajouté :(";}			
	}
?>
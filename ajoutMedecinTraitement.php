<?php

	include 'identifiantBDD.php';
	include 'connexionBDD.php';
	include 'verifConnecte.php';

	if(isset($_POST['civilite'],$_POST['nom'],$_POST['prenom'])){
		
		
		$req = $linkpdo->prepare('SELECT Nom,Prenom FROM Medecin WHERE Nom = :lenom AND Prenom = :leprenom'); 

		$req->execute(array('lenom' => $_POST['nom'],
					'leprenom' => $_POST['prenom']));

		$requeteVerif = $linkpdo->prepare('SELECT * FROM Medecin WHERE Nom = :lenom and Prenom = :leprenom');
		$requeteVerif -> execute(array('lenom' => $_POST['nom'], 'leprenom' => $_POST['prenom']));
		if($requeteVerif->fetchColumn() > 0){
			echo "Ce médecin existe déjà";
		}else{

			if(isset($req)){

				$req = $linkpdo->prepare('INSERT INTO Medecin (Civilite,Nom,Prenom) VALUES (:civ,:nom,:prenom)');

				$req->execute(array(
							'civ' => $_POST['civilite'],
							'nom' => $_POST['nom'], 
							'prenom' => $_POST['prenom']));

				header('location:rechercheMedecin.php');
				
			} else {
				echo "Medecin pas ajoute dommage !";
			}
		}
	}
	
	
?>
<?php 

	include 'identifiantBDD.php';
	include 'verifConnecte.php';

	if(isset($_GET['id'])){

		include'connexionBDD.php';
		
		$requete = $linkpdo->prepare('UPDATE Patient set IdMedecin = 0 where Idmedecin = :id');
		$requete->execute(array('id'=>$_GET['id']));

		$requete = $linkpdo->prepare('DELETE FROM Medecin WHERE IdMedecin = :id');
		$requete->execute(array('id'=>$_GET['id'])); 

	}
	header("location:rechercheMedecin.php")

?>
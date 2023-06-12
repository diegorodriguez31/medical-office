<?php
	include 'verifConnecte.php';
	include 'identifiantBDD.php';
	if(isset($_POST['dater'],$_POST['heure'],$_POST['idpat'],$_POST['idmed'],$_POST['duree'])){
		include 'connexionBDD.php';
		//cas ou l'heure de début est durant une autre consultation et cas ou l'heure de fin est durant une autre consultation
		$requeteVerif = $linkpdo-> prepare('SELECT count(*) FROM rendezvous WHERE IdMedecin = :idMed AND DateConsultation = :dateC AND (:heure BETWEEN HeureDebutConsultation AND ADDTIME(HeureDebutConsultation,sec_to_time(DureeConsultation * 60)) OR ADDTIME(:heure,sec_to_time(:duree*60)) BETWEEN HeureDebutConsultation AND ADDTIME(HeureDebutConsultation,sec_to_time(DureeConsultation * 60)))');
		$requeteVerif->execute(array('idMed'=> $_POST['idmed'],
									 'dateC'=> $_POST['dater'],
									 'heure'=> $_POST['heure'],
									 'duree'=> $_POST['duree']));
		$res = $requeteVerif->fetch();
        if($res['count(*)']>0){
        	header("location:consultation.php?erreur=1");
        	exit;
        }

		$req = $linkpdo->prepare('UPDATE rendezvous SET DateConsultation = :datec, HeureDebutConsultation = :heure, IdPatient = :idp , IdMedecin = :idm , DureeConsultation = :duree WHERE IdMedecin = :aid AND HeureDebutConsultation = :aHeure AND DateConsultation = :adate');

		$req->execute(array(
						'datec' => $_POST['dater'],
						'heure' => $_POST['heure'], 
						'idp' => $_POST['idpat'], 
						'idm' => $_POST['idmed'], 
						'duree'=> $_POST['duree'],
						'aid'=> $_POST['aDateC'],
						'aHeure'=> $_POST['aHeure'],
						'adate'=> $_POST['aId']));
	}

	header('location:consultation.php');

?>
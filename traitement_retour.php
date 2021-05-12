<?php 

	session_start(); // Démarrage de la session

	include("en_tete.html"); // Importation du code contenu dans en_tete.html

	// Récupération des variables du formulaire et stockage de ces variables dans des variables de session

	$_SESSION['note']=$_POST['note'];

	$_SESSION['film_note']=$_POST['film'];

	$_SESSION['avis']=$_POST['avis'];

	include("parametres_connexion_base.php"); // Paramètres de connexion

	try {
			$conn = new PDO("mysql:host=$serveur;dbname=$nom_base", $login, $password);
			
			// set the PDO error mode to exception
			// On insert les données du formulaire dans la table retour
			
			$req_insertion_retour='INSERT INTO retour(Pseudo_client,Id_film,note,avis) 
			VALUES("'.$_SESSION['pseudo'].'",(SELECT Id_film FROM films WHERE Titre_film="'.$_SESSION['film_note'].'"),"'.$_SESSION['note'].'","'.$_SESSION['avis'].'")';
			
			// Execution de la requête
			
			$conn->exec($req_insertion_retour);
			include("merci_retour.html");

	}catch (PDOException $e) {
			echo $req_insertion_retour . "<br>" . $e->getMessage();
		}
		
	
	include("retour_page_acceuil.html");
	include("pied_page.html"); // Importation du code contenu dans pied_page.html



?>

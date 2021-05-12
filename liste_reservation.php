<?php
	
	session_start(); // Démarrage de la session
	
	include("en_tete.html"); // Importation du code de l'en-tete 
	
	include("Phrase_liste_reservations.html");
	
	include("parametres_connexion_base.php"); // Paramètres de connexion
	
	try {
		$conn = new PDO("mysql:host=$serveur;dbname=$nom_base", $login, $password); // Ouverture de la connexion avec les bons paramètres
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// set the PDO error mode to exception
		// Requête pour avoir le film et la date de fin de réservation 
		$req_liste_reservations='SELECT Titre_film,Date_fin FROM clients_films,films WHERE clients_films.Id_film=films.Id_film and clients_films.Pseudo_client="'.$_SESSION['pseudo'].'"';
		// Execution de la requête
		$req_liste_res=$conn->query($req_liste_reservations);
				
	
			
	}catch (PDOException $e) {
		echo $req_liste_reservations . "<br>" . $e->getMessage();
	}
	while ($liste_reservations = $req_liste_res->fetch(PDO::FETCH_ASSOC)){ // On parcourt le resultat de la requête
	
		include("retour_ligne.html"); // On revient à la ligne
		
		echo "Film : ";
		
		echo $liste_reservations['Titre_film']; // On affiche le pseudo de l'utilisateur
		
		include("retour_ligne.html");
		
		echo " Date de la fin de la location : ";
		
		echo $liste_reservations['Date_fin']; // On affiche l'avis de l'utilisateur en question
		
		include("retour_ligne.html");
		
		include("retour_ligne.html");
		

	}
	
	include("retour_page_acceuil.html");
	
	include("pied_page.html"); // Importation du code de pied de page

?>
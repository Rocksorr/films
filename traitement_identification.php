<?php 
	session_start(); // Démarrage de la session
	
	include("en_tete.html"); // Génération du code contenu dans le fichier en_tete.html
  
	include("parametres_connexion_base.php"); // Importation du code qui définit les paramètres de connexion
		
	//On récupère les valeurs entrées par le client
	
	$_SESSION['pseudo']=$_POST['pseudo'];
	$_SESSION['mdp']=$_POST['mdp'];
	
	try { // Ouverture d'un try, nécessaire pour réaliser des requêtes SQLs
		$conn = new PDO("mysql:host=$serveur;dbname=$nom_base", $login, $password); // On déclare une connexion avec les paramètres obtenus via le fichier parametres_connexion_base.php
		// set the PDO error mode to exception
		$req_identifiant='SELECT Pseudo FROM clients WHERE Pseudo="'.$_SESSION['pseudo'].'"'; // On regarde si le pseudo rentré est dans la base à l'aide d'une requête.
		$req_mot_de_passe='SELECT mot_de_passe FROM clients WHERE Pseudo = "'.$_SESSION['pseudo'].'" and mot_de_passe="'.$_SESSION['mdp'].'"'; // On regarde si le mot de passe rentré correspond au pseudo rentré
		$reponse=$conn->query($req_identifiant); // Execution de la requête req_identifiant
		$reponse2=$conn->query($req_mot_de_passe);	// Execution de la requête req_mot_de_passe				
		
		
	}catch (PDOException $e) { // On ouvre un catch, nécessaire loresqu'on fait un try
			echo $req . "<br>" . $e->getMessage();
	}	
		
	$conn = null; // On ferme la connexion
	
	// Création d'un compteur i

	$i=0;
	
	while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC)){ // On parcourt le resultat de la requête
	
		$i++; // Incrémentation du compteur i 
	
	}
	// Création d'un compteur j
	
	$j=0;
	
	while ($donnees2 = $reponse2->fetch(PDO::FETCH_ASSOC)){ // On parcourt le resultat de la requête
		
		$j++; // Incrémentation du compteur j
	}
	
	// Enregistrement du pseudo dans une variable utile à la manipulation	
	
	if ($i==1 and $j==1){ // Si i=1 et j=1 
		include("Authentification_reussie.html");
		include("retour_ligne.html"); // On implémente le code qui permet de revenir à la ligne
		include("retour_ligne.html");
		include("retour_ligne.html");
		include("boutons_indentification.html"); // On implémente le code contenu dans boutons_indentification.html
		include("retour_ligne.html");
		include("retour_page_acceuil.html");
	}else{ // Sinon
		include("Phrase_echec_identification.html");
		include("bouton_echec_identification.html"); // On renvoie l'utlisateur à la page d'inscription
	}
 
	include("pied_page.html"); // Importation du code contenu dans pied_page.html
?>
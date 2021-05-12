<?php 
	include("en_tete.html"); // Importation du code d'en-tete
	
	include("parametres_connexion_base.php"); // Importation du code qui sert à se connecter à la base
		
	try { // Ouverture d'un try

		$conn = new PDO("mysql:host=$serveur;dbname=$nom_base", $login, $password); // Déclaration d'une connexion à la base de données
		// set the PDO error mode to exception
		$req_affichage_film='SELECT Titre_film FROM films ORDER BY Titre_film'; // On enregistre tout les noms de film à l'aide d'une requête.
		$rep=$conn->query($req_affichage_film);	// Execution de la requête				
			
			
	}catch (PDOException $e) { // On fait un catch, nécéssaire lorsqu'on fait un try
			echo $rep . "<br>" . $e->getMessage();
	}	
		
	include("pied_page.html"); // On importe le code contenu dans le script pied_page.html.
?>	
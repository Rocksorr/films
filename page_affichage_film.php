<?php 
		session_start(); // Demarrage de la session
		
		include("en_tete.html"); // Importation du code de l'en tete 
	
		include ("page_film.php"); // Importation du code contenu dans page_film.php
	
		include("Phrase_film.html"); // Importation du code contenu dans Phrase_film.html
	
		include("formulaire_liste_deroulante.html"); // Importation du code contenu dans formulaire_liste_deroulante.html

		while ($donnees = $rep->fetch(PDO::FETCH_ASSOC)){ // On parcourt le résultat de la requête 
			echo "<option>" .$donnees['Titre_film']; // On affiche les films dans la liste déroulante
		}
		include("fermeture_liste.html"); // On ferme la liste déroulante via le code contenu dans le fichier fermeture_liste.html
		
		include("retour_ligne.html");
		
		include("Bouton_fin_formulaire.html"); // On importe le code qui sert à afficher le bouton du formulaire
			
		include("pied_page.html"); // On importe le code conteu dans pied_page.html
		
?>
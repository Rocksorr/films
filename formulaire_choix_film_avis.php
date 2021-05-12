<?php 
	session_start(); // Demarrage de la session
		
	include("en_tete.html"); // Importation du code contenu dans en_tete.html
	
	include ("page_film.php"); // Importation du code contenu dans page_film.php
	
	include("Phrase_avis.html"); // Importation du code contenu dans Phrase_avis.html
	
	include("formulaire_liste_avis.html"); // Importation du code contenu dans fermeture_liste_avis.html

	while ($donnees = $rep->fetch(PDO::FETCH_ASSOC)){ // On parcourt le résultat de la requête
		echo "<option>" .$donnees['Titre_film']; // On affiche les films dans la liste déroulante
	}
	include("fermeture_liste.html"); // Importation du code contenu dans fermeture_liste.html
	
	include("retour_ligne.html");
		
	include("Bouton_fin_formulaire.html"); // Importation du code contenu dans Bouton_fin_formulaire.html
			
	include("pied_page.html"); // Importation du code contenu dans pied_page.html
		
?>